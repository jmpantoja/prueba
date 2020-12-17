import {AdminContext} from "../../types";

declare module '@nuxt/types' {
  interface Context {
    $profile: Profile
  }
}

class Profile {
  private context: AdminContext;

  public constructor(context: AdminContext) {
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
