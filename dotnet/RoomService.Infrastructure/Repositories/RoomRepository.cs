using Microsoft.EntityFrameworkCore;
using RoomService.Domain.Entities;
using RoomService.Domain.Interfaces;
using RoomService.Infrastructure.Data;


namespace RoomService.Infrastructure.Repositories
{
    public class RoomRepository(AppDbContext context): IRoomRepository
    {
        public async Task<List<Room>> GetAllAsync() => await context.Rooms.ToListAsync();
        public async Task<Room?> GetByIdAsync(int id) => await context.Rooms.FindAsync(id);
        public async Task<Room> AddAsync(Room room)
        {
            context.Rooms.Add(room);
            await context.SaveChangesAsync();
            return room;
        }
        public async Task UpdateAsync(Room room)
        {
            context.Entry(room).State = EntityState.Modified;
            await context.SaveChangesAsync();
        }
        public async Task DeleteAsync(int id)
        {
            var room = await context.Rooms.FindAsync(id);
            if (room != null)
            {
                context.Rooms.Remove(room);
                await context.SaveChangesAsync();
            }
        }
    }
}
