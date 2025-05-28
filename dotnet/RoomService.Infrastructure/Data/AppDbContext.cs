using Microsoft.EntityFrameworkCore;
using RoomService.Domain.Entities;


namespace RoomService.Infrastructure.Data
{
    public class AppDbContext : DbContext
    {
        public AppDbContext(DbContextOptions options) : base(options) { }
        public DbSet<Room> Rooms => Set<Room>();
        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            modelBuilder.Entity<Room>(entity =>
            {
                entity.ToTable("rooms"); // nom exact de la table Laravel

                entity.HasKey(r => r.Id);

                entity.Property(r => r.Id).HasColumnName("id");
                entity.Property(r => r.Name).HasColumnName("name");
                entity.Property(r => r.Description).HasColumnName("description");
                entity.Property(r => r.Capacity).HasColumnName("capacity");
                entity.Property(r => r.CreatedAt).HasColumnName("created_at");
                entity.Property(r => r.UpdatedAt).HasColumnName("updated_at");
            });
        }
    }
}
