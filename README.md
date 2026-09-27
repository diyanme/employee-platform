# Employee Platform

A containerized Laravel application with automated CI/CD, GitHub Container Registry publishing, and GitOps-based deployment.

## Architecture

```text
Developer
   │
   ▼
GitHub Repository
   │
   ▼
GitHub Actions
   ├── Laravel Tests
   ├── Docker Build
   ├── Push image → GHCR
   └── Update GitOps repository
              │
              ▼
        Argo CD detects change
              │
              ▼
        Kubernetes / K3s
              │
              ▼
       Employee Platform
```

## Technology Stack

- Laravel / PHP 8.3
- MySQL 8
- Docker
- Docker Compose
- GitHub Actions
- GitHub Container Registry (GHCR)
- Kubernetes / K3s
- Helm
- Argo CD
- GitOps

## Repository Structure

```text
employee-platform/
├── .github/
│   └── workflows/
│       └── ci.yml
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── Dockerfile
├── compose.yml
├── composer.json
└── package.json
```

## Local Docker Deployment

Build and start the application:

```bash
docker compose -f compose.yml build
docker compose -f compose.yml up -d
```

Run migrations:

```bash
docker compose -f compose.yml exec -T app php artisan migrate --force
```

Application:

```text
http://localhost:8000
```

## CI/CD Pipeline

The workflow is defined in:

```text
.github/workflows/ci.yml
```

### CI

For pushes and pull requests to `main` and `develop`:

1. Checkout source code.
2. Install PHP dependencies.
3. Prepare Laravel environment.
4. Generate application key.
5. Run Laravel tests.
6. Build the Docker image.

### Container Publishing

Successful builds publish images to:

```text
ghcr.io/diyanme/employee-platform
```

Images are tagged with the Git commit SHA and `latest`.

### GitOps Update

After publishing the image, GitHub Actions updates the appropriate GitOps environment:

```text
develop → staging
main    → production
```

The deployment uses an immutable Git commit SHA rather than a mutable environment tag.

### Deployment

The production deployment runs through the self-hosted GitHub Actions runner on the K3s deployment server.

The deployment performs:

```text
Pull image
   ↓
Deploy application
   ↓
Run Laravel migrations
   ↓
Health verification
```

## Environments

| Branch    | Environment | Kubernetes Namespace  |
| --------- | ----------- | --------------------- |
| `develop` | Staging     | `employee-staging`    |
| `main`    | Production  | `employee-production` |

## Security

Secrets are not committed to the repository.

GitHub Actions uses GitHub-provided authentication for GHCR and a repository secret for GitOps repository access.

Kubernetes application configuration is provided through Kubernetes Secrets.

## Deployment Verification

The pipeline verifies the deployed application after deployment using:

```bash
curl -fsS http://127.0.0.1:8000/employees
```

## Related Repositories

- Infrastructure: `employee-platform-infrastructure`
- GitOps: `employee-platform-gitops`
