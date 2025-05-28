using RoomService.Domain.Interfaces;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace RoomService.Application.UsesCases.Rooms
{
    public class DeleteRoom(IRoomRepository repo)
    {
        public async Task ExecuteAsync(int id) => await repo.DeleteAsync(id);
    }
}
