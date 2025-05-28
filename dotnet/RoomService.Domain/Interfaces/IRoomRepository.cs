using RoomService.Domain.Entities;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace RoomService.Domain.Interfaces
{
    public interface IRoomRepository
    {
        Task<List<Room>> GetAllAsync();
        Task<Room?> GetByIdAsync(int id);
        Task<Room> AddAsync(Room room);
        Task UpdateAsync(Room room);
        Task DeleteAsync(int id);
    }
}
