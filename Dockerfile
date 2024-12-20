FROM ubuntu:latest
LABEL authors="vitrasethy"

ENTRYPOINT ["top", "-b"]
