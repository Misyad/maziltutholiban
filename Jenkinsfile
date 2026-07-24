pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                checkout scm
            }
        }
        
        stage('Setup Environment') {
            steps {
                script {
                    if (!fileExists('.env')) {
                        echo "Menyalin .env.example ke .env"
                        sh 'cp .env.example .env'
                    }
                }
            }
        }
        
        stage('Build & Deploy via Docker Compose') {
            steps {
                echo "Membangun Image Production dan Menjalankan Container"
                sh 'docker-compose -f docker-compose.prod.yml up -d --build'
            }
        }
        
        stage('Post-Deploy Setup') {
            steps {
                echo "Generate Application Key"
                sh 'docker-compose -f docker-compose.prod.yml exec -T app php artisan key:generate'
                
                echo "Optimize Configuration"
                sh 'docker-compose -f docker-compose.prod.yml exec -T app php artisan config:cache'
                sh 'docker-compose -f docker-compose.prod.yml exec -T app php artisan route:cache'
                sh 'docker-compose -f docker-compose.prod.yml exec -T app php artisan view:cache'
                
                echo "Menunggu database siap (15 detik)..."
                sh 'sleep 15'
                sh 'docker-compose -f docker-compose.prod.yml ps'
                
                echo "Menjalankan Migrasi Database"
                sh '''
                if ! docker-compose -f docker-compose.prod.yml exec -T app php artisan migrate --force; then
                    echo "Migrasi gagal, menampilkan log dari container mysql:"
                    docker-compose -f docker-compose.prod.yml logs mysql
                    exit 1
                fi
                '''
            }
        }
    }
    
    post {
        always {
            echo "Pipeline deployment selesai dieksekusi."
            // Clean up dangling images to save space on home server
            sh 'docker image prune -f || true'
        }
        success {
            echo "Deploy berhasil!"
        }
        failure {
            echo "Deploy gagal, silakan cek log."
        }
    }
}
