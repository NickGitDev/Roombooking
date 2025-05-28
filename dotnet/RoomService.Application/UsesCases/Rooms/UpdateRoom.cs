using RoomService.Domain.Entities;
using RoomService.Domain.Interfaces;


namespace RoomService.Application.UsesCases.Rooms
{
    public class UpdateRoom(IRoomRepository repo)
    {
        public async Task ExecuteAsync(Room room) =>await repo.UpdateAsync(room);
    }
}
