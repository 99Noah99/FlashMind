FROM ollama/ollama:latest

COPY Modelfile /Modelfile

RUN ollama serve & \
    sleep 5 && \
    ollama create FlashCardGenerator -f ./Modelfile && \
    ollama rm gemma3:4b

ENTRYPOINT ["ollama", "serve"]

