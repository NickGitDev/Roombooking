# Projet RoomBooking - Architecture Microservices avec API Gateway

Ce projet repose sur une architecture moderne avec :
- Laravel pour le front office (port 8000)
- Un microservice RoomService en .NET 8 (port 5000/8080)
- Une API Gateway en .NET 8 avec Ocelot (port 7000)
- Une base de données MySQL (port 3306)
- Docker + Docker Compose

## Structure du projet

```
├── roombooking/                  # Application Laravel (Front)
├── dotnet/
│   ├── RoomService.API/         # API principale des rooms
│   ├── RoomService.Application/
│   ├── RoomService.Infrastructure/
│   └── RoomService.Domain/
├── api-gateway/                 # API Gateway avec Ocelot
│   └── ocelot.json
├── docker-compose.yml
```

---

## Lancement du projet

### 1. Pré-requis

- Docker et Docker Compose
- Port 7000, 8000, 5000, 3306 libres

### 2. Lancer les conteneurs

```bash
docker compose up --build -d
```

### 3. Accès

- Laravel : http://localhost:8000
- RoomService (.NET) : http://localhost:5000/swagger/index.html
- API Gateway (Ocelot) : http://localhost:7000/rooms

---

##  Test API Gateway (avec Postman)

### Exemple de requête GET :

```
GET http://localhost:7000/rooms
```

### Exemple de POST :

```
POST http://localhost:7000/rooms
Content-Type: application/json

{
  "name": "Salle 101",
  "description": "Salle de réunion",
  "capacity": 20
}
```

---

## Fichier `.env` (Laravel)

```dotenv
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=roombooking
DB_USERNAME=root
DB_PASSWORD=secret
```

---

## Docker : fichiers importants

### docker-compose.yml
Décrit les services Laravel, RoomService, Gateway, et MySQL

### ocelot.json
Configure les routes de l’API Gateway :

```json
{
  "Routes": [
    {
      "DownstreamPathTemplate": "/api/Rooms",
      "UpstreamPathTemplate": "/rooms",
      "UpstreamHttpMethod": [ "GET", "POST", "PUT", "DELETE" ],
      "DownstreamHostAndPorts": [
        { "Host": "roomservice-api", "Port": 8080 }
      ],
      "DownstreamScheme": "http"
    }
  ],
  "GlobalConfiguration": {
    "BaseUrl": "http://localhost:7000"
  }
}
```

---

## Base de données

Connectez-vous au conteneur MySQL :
```bash
docker exec -it roombooking-db mysql -u root -p
```

Puis vérifiez la table `rooms` :
```sql
USE roombooking;
SELECT * FROM rooms;
```

---

## Tout est fonctionnel !

- [x] Laravel en http://localhost:8000
- [x] RoomService en http://localhost:5000
- [x] Gateway Ocelot en http://localhost:7000
- [x] Communication API entre services
- [x] Swagger et tests Postman

---
