import Auth from "@nuxtjs/auth-next/dist/core/auth";

type Context = { $auth: Auth };

class Profile {
  private context: Context;

  public constructor(context: Context) {
    this.context = context
  }

  logout() {
    this.context.$auth.logout()
  }

  profile() {
    alert('has pulsado en profile')
  }
}

export default Profile;
