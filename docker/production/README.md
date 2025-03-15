# Build Script - `build`

This project contains a build script (`build`) located in `docker/production`. It performs various tasks such as copying necessary files to the production folder, deleting unnecessary files, and exporting a Docker image.

## Prerequisites

Before running the script, make sure you meet the following requirements:

- **Compatible operating system**: Linux, macOS, or Windows with Docker support.
- **Docker**: Ensure Docker is installed and properly configured. To install Docker, follow the [official instructions](https://docs.docker.com/get-docker/).
- **Execution permissions**: Make sure the script has execution permissions. You can grant permissions using:

```bash
chmod +x docker/production/build.sh
```

## Build action

To build the project, simply run the `build` file located at: `/docker/production`

```bash
build
```
