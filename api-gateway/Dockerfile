# Étape 1 : build
FROM mcr.microsoft.com/dotnet/sdk:8.0 AS build
WORKDIR /src

# Copie les fichiers du projet
COPY . .

# Restaure les packages
RUN dotnet restore

# Compile et publie l'app
RUN dotnet publish -c Release -o /app/publish

# Étape 2 : runtime
FROM mcr.microsoft.com/dotnet/aspnet:8.0 AS final
WORKDIR /app

COPY --from=build /app/publish .

# Port par défaut de l’API Gateway
EXPOSE 80

ENTRYPOINT ["dotnet", "ApiGateway.dll"]
