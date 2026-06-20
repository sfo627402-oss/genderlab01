# BioScan AI — Plateforme de Sexage Moléculaire & Pathogènes

![BioScan AI Banner](https://images.unsplash.com/photo-1579154204601-01588f351e67?auto=format&fit=crop&w=1200&q=80)

## 🧬 Présentation
BioScan AI est un écosystème numérique complet dédié au **sexage moléculaire** fiable des espèces monomorphes, ainsi qu'à la **détection de pathogènes** (virus, bactéries et parasites) chez les oiseaux.

La plateforme combine biologie moléculaire avancée, IA (Intelligence Artificielle) et technologies Web/Mobile pour offrir des analyses rapides, standardisées et accessibles aux éleveurs, vétérinaires et centres de conservation.

## 🚀 Fonctionnalités Clés

### Pour les Clients (Éleveurs)
- **Soumission Intelligente** : Formulaire multi-étapes avec QR Code unique par échantillon.
- **Scanner IA de Qualité** : Vérification par photo de la viabilité du prélèvement avant envoi.
- **Suivi en Temps Réel** : Dashboard interactif pour suivre l'évolution de l'analyse.
- **Rapports Certifiés** : Téléchargement de certificats PDF sécurisés après validation.
- **Version Premium** : Assistance IA illimitée, conseils sanitaires et propositions de croisements.

### Pour les Biologistes
- **Console de Gestion** : Vue complète des arrivées, triée par famille (phylogénétique).
- **Aide au Diagnostic** : Affichage automatique des **Jeux d'Amorces PCR (Primer Sets)** selon l'espèce.
- **IA Électrophorèse** : Support à l'analyse des images de gel pour extraire les résultats.
- **Système d'Alertes** : Détection automatique des anomalies et demandes de re-test.

## 🛠️ Stack Technique
- **Framework** : Laravel 11
- **Frontend** : Tailwind CSS, Alpine.js (Design inspiré par Iberogen)
- **Base de données** : SQLite (Dev) / MySQL (Prod)
- **IA** : Modèles de vision pour l'analyse de qualité et d'électrophorèse

## 📦 Installation locale
```bash
# Cloner le projet
git clone https://github.com/Aymen-dev-dz/bioscan-ai.git

# Installer les dépendances
composer install
npm install

# Configurer l'environnement
cp .env.example .env
php artisan key:generate

# Migrations & Seeders
php artisan migrate --seed

# Lancer le serveur
php artisan serve
npm run dev
```

---
*Développé avec ❤️ pour la communauté aviaire.*
