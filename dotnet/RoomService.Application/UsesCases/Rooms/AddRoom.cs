using RoomService.Domain.Entities;
using RoomService.Domain.Interfaces;


namespace RoomService.Application.UsesCases.Rooms
{
    public class AddRoom(IRoomRepository repo)
    {
        public async Task<Room> ExecuteAsync(Room room) => await repo.AddAsync(room); 
    }
}
