# 🎓 Assignment 2 : Création d’un MiniBlog avec Laravel

## 📌 Objectif pédagogique

Cet exercice vous permet d’approfondir vos connaissances de Laravel, notamment :
- la gestion des modèles et des relations Eloquent,
- la création de formulaires avec validation,
- les opérations CRUD (Create, Read, Update, Delete),
- la structuration d’un petit projet MVC,
- l’utilisation des vues Blade.

---

## 🧠 Scénario

Vous devez développer une petite application appelée **MiniBlog**, permettant :
- de publier des publications,
- d’afficher ces publications,
- de permettre à des visiteurs de laisser des commentaires sous chaque publication.

---

## 🔧 Fonctionnalités à implémenter

### 1. Gestion des publications

#### ➕ Création d’un publication
- Page : `/publications/create`
- Champs :
  - Titre (min 5 caractères)
  - Contenu
- Validation obligatoire sur les champs

#### 📄 Liste des publications
- Page : `/publications`
- Affiche la liste de tous les publications, du plus récent au plus ancien

#### 🔍 Détail d’un publication
- Page : `/publications/{id}`
- Affiche :
  - le titre et le contenu de l’publication
  - tous les commentaires associés
  - un formulaire pour ajouter un commentaire

#### ✏️ Édition d’un publication
- Page : `/publications/{id}/edit`
- Pré-remplit les champs pour édition

#### ❌ Suppression d’un publication
- Fonctionnalité de suppression avec redirection

---

### 2. Commentaires

#### ➕ Ajout d’un commentaire
- Depuis la page d’un publication
- Champs :
  - Nom
  - Contenu du commentaire (min 10 caractères)
- Les commentaires sont affichés sous l’publication

---

## 🗃️ Structure des tables

### Table `publications`
| Champ      | Type      | Contraintes            |
|------------|-----------|------------------------|
| id         | integer   | Auto-incrémenté        |
| title      | string    | min:5, required        |
| content    | text      | required               |
| timestamps |           | created_at, updated_at |

### Table `comments`
| Champ      | Type      | Contraintes                 |
|------------|-----------|-----------------------------|
| id         | integer   | Auto-incrémenté             |
| publication_id | integer   | Foreign key -> publications.id  |
| name       | string    | required                    |
| comment    | text      | min:10, required            |
| timestamps |           | created_at, updated_at      |

---

## 🔁 Relations Eloquent

- `Publication` :
  ```php
  public function comments()
  {
      return $this->hasMany(Comment::class);
  }
  ```

- `Comment` :
  ```php
  public function publication()
  {
      return $this->belongsTo(Publication::class);
  }
  ```

---

## 🗂️ Organisation recommandée

- **Modèles** : `Publication`, `Comment`
- **Contrôleurs** : `PublicationController`, `CommentController`
- **Vues** (dans `resources/views/publications`) :
  - `index.blade.php`
  - `create.blade.php`
  - `edit.blade.php`
  - `show.blade.php`

---

## ✅ Contraintes techniques

- Affichage des erreurs de validation dans les vues Blade
- Utilisation de layout Blade (`layouts.app`) recommandé
- Utilisation de Bootstrap ou Tailwind facultative mais encouragée

---

## 🎁 Bonus

- Ajouter une pagination (`paginate(5)`)
- Ajouter une barre de recherche d’publications
- Styliser les formulaires et les listes avec un framework CSS

---

Bon courage ! 💪
