using RoomService.Domain.Entities;
using RoomService.Domain.Interfaces;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace RoomService.Application.UsesCases.Rooms
{
    public class GetAllRooms(IRoomRepository repo)
    {
        public async Task<List<Room>> ExecuteAsync() => await repo.GetAllAsync();
    }
}
