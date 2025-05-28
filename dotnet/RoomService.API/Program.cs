using Microsoft.EntityFrameworkCore;

using RoomService.Application.UsesCases.Rooms;
using RoomService.Domain.Interfaces;
using RoomService.Infrastructure.Data;
using RoomService.Infrastructure.Repositories;






var builder = WebApplication.CreateBuilder(args);

// Add services to the container.

builder.Services.AddControllers();
// Learn more about configuring Swagger/OpenAPI at https://aka.ms/aspnetcore/swashbuckle
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();


builder.Services.AddDbContext<AppDbContext>(options =>
{
    var connectionString = builder.Configuration.GetConnectionString("DefaultConnection");
    var serverVersion = ServerVersion.AutoDetect(connectionString);
    options.UseMySql(connectionString, serverVersion)
        .LogTo(Console.WriteLine, LogLevel.Information)
        .EnableSensitiveDataLogging()
        .EnableDetailedErrors();;
});
//options.UseMySql(builder.Configuration.GetConnectionString("DefaultConnection"))

builder.Services.AddScoped<IRoomRepository, RoomRepository>();
builder.Services.AddScoped<GetAllRooms>();
builder.Services.AddScoped<AddRoom>();
builder.Services.AddScoped< DeleteRoom>();
builder.Services.AddScoped<UpdateRoom>();

// Ajout de Swagger pour debug
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();
builder.Services.AddControllers();

var app = builder.Build();

/*/ Configure the HTTP request pipeline.
if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
}*/

 app.UseSwagger();
app.UseSwaggerUI();

//app.UseHttpsRedirection();

app.UseAuthorization();

app.MapControllers();

app.Run();
