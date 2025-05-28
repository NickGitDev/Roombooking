FROM mcr.microsoft.com/dotnet/aspnet:8.0 AS base
WORKDIR /app
EXPOSE 80

FROM mcr.microsoft.com/dotnet/sdk:8.0 AS build
ARG BUILD_CONFIGURATION=Release
WORKDIR /src

# Copier toute la solution
COPY . .

# Restaurer toutes les références de projets
RUN dotnet restore RoomService.API/RoomService.API.csproj

# Build
RUN dotnet build RoomService.API/RoomService.API.csproj -c $BUILD_CONFIGURATION -o /app/build

# Publish
RUN dotnet publish RoomService.API/RoomService.API.csproj -c $BUILD_CONFIGURATION -o /app/publish /p:UseAppHost=false

FROM base AS final
WORKDIR /app
COPY --from=build /app/publish .
ENTRYPOINT ["dotnet", "RoomService.API.dll"]
