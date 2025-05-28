import { Routes } from '@angular/router';
import { RoomListeComponent } from './components/room-liste/room-liste.component';
import { RoomFormComponent } from './components/room-form/room-form.component';

export const routes: Routes = [
  { path: 'salles', component: RoomListeComponent },
  { path: 'ajouter-salle', component: RoomFormComponent },
  { path: '', redirectTo: 'salles', pathMatch: 'full' },
];
