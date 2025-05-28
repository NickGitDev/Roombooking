import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RoomListeComponent } from './room-liste.component';

describe('RoomListeComponent', () => {
  let component: RoomListeComponent;
  let fixture: ComponentFixture<RoomListeComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [RoomListeComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(RoomListeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
