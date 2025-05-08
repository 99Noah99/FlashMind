FROM ollama/ollama:latest

COPY Modelfile /Modelfile

RUN ollama serve & \
    sleep 5 && \
    ollama create FlashCardGenerator -f ./Modelfile && \
    ollama rm llama3.1

ENTRYPOINT ["ollama", "serve"]

