using Microsoft.AspNetCore.Http;
using Microsoft.AspNetCore.Mvc;
using RoomService.Application.UsesCases.Rooms;
using RoomService.Domain.Entities;

namespace RoomService.API.Controllers
{
    [Route("api/[controller]")]
    [ApiController]
    public class RoomsController
        (
         GetAllRooms getAllRooms,
         AddRoom addRoom, 
         UpdateRoom updateRoom, 
         DeleteRoom deleteRoom

        ) : ControllerBase
    {
        [HttpGet]
        public async Task<IActionResult> Get()
        {
            try
            {
                var rooms = await getAllRooms.ExecuteAsync();
                return Ok(rooms);
            }
            catch (Exception ex)
            {
                return StatusCode(500, new { error = ex.Message, stack = ex.StackTrace });
            }
        }

        [HttpPost]
        public async Task<IActionResult> Post([FromBody] Room room)
        {
            var result = await addRoom.ExecuteAsync(room);
            return CreatedAtAction(nameof(Get), new { id = result.Id }, result);
        }

        [HttpPut("{id}")]
        public async Task<IActionResult> Put(int id, [FromBody] Room room)
        {
            if (id != room.Id) return BadRequest();
            await updateRoom.ExecuteAsync(room);
            return NoContent();
        }

        [HttpDelete("{id}")]
        public async Task<IActionResult> Delete(int id)
        {
            await deleteRoom.ExecuteAsync(id);
            return NoContent();
        }


    }
}
