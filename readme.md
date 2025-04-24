# FlashMind - Application de génération de Flashcards

FlashMind est une application qui permet de générer des **flashcards** à partir de documents ou de textes. Ces flashcards peuvent ensuite être exportées au format CSV pour être importées dans des applications comme **Anki**.

### Fonctionnalités :
- **Analyse de texte** : Envoie un texte ou un document et génère des flashcards automatiquement.
- **Export en CSV** : Exportez les flashcards générées au format CSV pour les importer facilement dans Anki.
- **Interface front-end** : Utilise **React** avec **Inertia.js** pour une expérience utilisateur fluide et moderne.
- **Utilisation de Laravel** : Laravel est utilisé pour la logique back-end, avec une architecture propre et évolutive.
- **Architecture Dockerisée** : Le projet utilise **Docker** pour faciliter la mise en place de l'environnement de développement.

---

## 🚀 Mise en place du projet

### Prérequis :
- **Docker** et **Docker Compose** installés sur votre machine.
- **WSL 2** (Windows Subsystem for Linux) sur Windows si vous utilisez Windows sinon **linux**.

### Étapes pour lancer le projet :

1. **Cloner le projet depuis GitHub** :
   ```bash
   git clone https://github.com/votre-utilisateur/flashmind.git
   cd flashmind
   ```

2. **Vérification de Docker et Docker Compose** :
   - Avant de continuer, assurez-vous que Docker fonctionne bien et que Docker Compose est installé :
     ```bash
     docker --version
     docker-compose --version
     ```

3. **Lancer les conteneurs Docker** :
   - Assurez-vous que Docker est en cours d'exécution, puis lancez les services avec Docker Compose :
     ```bash
     docker-compose up -d
     ```
     Cela va télécharger les images nécessaires et démarrer les conteneurs pour Laravel, Node.js (pour Vite), Nginx, et Ollama.

4. **Accéder à l'application dans le navigateur** :
   - **Nginx (Laravel)** : Accédez à l'application Laravel via `http://localhost:8080`.
