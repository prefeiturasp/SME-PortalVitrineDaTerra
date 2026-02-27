docker_compose('docker-compose.yml')
docker_build('wordpress/vitrinedaterra', '.', dockerfile='Dockerfile.dev',
  live_update = [
    sync('.', '/var/www/html')
  ])