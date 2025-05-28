import { Component, OnInit } from '@angular/core';
import { RoomService, Room } from '../../services/room.service';

@Component({
  selector: 'app-room-liste',
  imports: [],
  templateUrl: './room-liste.component.html',
  styleUrl: './room-liste.component.css',
})
export class RoomListeComponent implements OnInit {
  rooms: Room[] = [];

  constructor(private roomService: RoomService) {}

  ngOnInit(): void {
    this.loadRooms();
  }

  loadRooms(): void {
    this.roomService.getRooms().subscribe((data) => (this.rooms = data));
  }

  deleteRoom(id: number): void {
    this.roomService.deleteRoom(id).subscribe(() => this.loadRooms());
  }
}
