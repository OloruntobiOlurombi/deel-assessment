pipeline {
    agent any
    
    environment {
        SERVICE_NAME = "reverse-ip"
        ORGANIZATION_NAME = "frankisinfotech"
        DOCKERHUB_USERNAME = "frankisinfotech"
        REPOSITORY_TAG = "${DOCKERHUB_USERNAME}/${ORGANIZATION_NAME}-${SERVICE_NAME}:${BUILD_ID}"
        GITHUB_TOKEN=credentials('github-token')

    }
    
    stages {
	    
        stage ('Scan Repo') {
	    steps {
		    sh 'trivy repo https://github.com/frankisinfotech/deel-assessment.git'
	    }
	}
	    
	stage ('Scan IaC') {
	    steps {
		    sh 'trivy conf --severity HIGH,CRITICAL  ./iac'
	    }
	}
        stage ('Build and Push Image') {
            steps {
                 withDockerRegistry([credentialsId: 'DOCKERHUB_USERNAME', url: ""]) {
                   sh 'docker build -t ${REPOSITORY_TAG} .'
                   sh 'docker push ${REPOSITORY_TAG}'        
            }
          }
       }
        
       stage("Install kubectl"){
            steps {
                sh """
                    curl -LO https://storage.googleapis.com/kubernetes-release/release/`curl -s https://storage.googleapis.com/kubernetes-release/release/stable.txt`/bin/linux/amd64/kubectl
                    chmod +x ./kubectl
                    ./kubectl version --client
                """
            }
        }
    
       stage ('Deploy to Cluster') {
            steps {
                sh "aws eks update-kubeconfig --region eu-west-1 --name deel-cluster"
                sh " envsubst < ${WORKSPACE}/deploy.yaml | ./kubectl apply -f - "
            }
    }
   
	    
}
}
