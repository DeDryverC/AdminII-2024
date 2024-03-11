# Utilise l'image officielle Python comme image de base
FROM python:3.9-slim

# Définit le répertoire de travail dans le conteneur
WORKDIR /app

# Copie le script Python dans le répertoire de travail
COPY show_time.py /app

# Exécute le script Python au démarrage du conteneur
CMD ["python", "./show_time.py"]

