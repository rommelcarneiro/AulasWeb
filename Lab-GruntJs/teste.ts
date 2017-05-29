import { Component } from '@angular/core';

@Component({
  selector: 'login_form',
  template: ` <div>
      <h2>Login</h2>
      <input type="email" name="email">
      <input type="password" name="password">
      <span>Forgot Password</span>
      <button>Login</button>
    </div>  `
})
export class LoginComponent {
  constructor() {

  }  
}

