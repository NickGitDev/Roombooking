import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

export interface Room {
  id: number;
  name: string;
  capacity: number;
  description: string;
}
@Injectable({
  providedIn: 'root',
})
export class RoomService {
  private baseUrl = 'http://localhost:8080/api/rooms';

  constructor(private http: HttpClient) {}

  getRooms() {
    return this.http.get<Room[]>(this.baseUrl);
  }

  getRoomById(id: number) {
    return this.http.get<Room>(`${this.baseUrl}/${id}`);
  }
  createRoom(room: Room) {
    return this.http.post<Room>(this.baseUrl, room);
  }
  updateRoom(id: number, room: Room) {
    return this.http.put<Room>(`${this.baseUrl}/${id}`, room);
  }
  deleteRoom(id: number) {
    return this.http.delete(`${this.baseUrl}/${id}`);
  }
}
