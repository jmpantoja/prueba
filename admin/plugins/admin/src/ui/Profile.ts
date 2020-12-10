import {NuxtApp} from "../types";

declare module '@nuxt/types' {
  interface Context {
    $profile: Profile
  }
}

class Profile {
  private app: NuxtApp;

  public constructor(app: NuxtApp) {
    this.app = app
  }

  logout() {
    this.app.$auth.logout()
  }

  profile() {
    alert('has pulsado en profile')
  }
}

export default Profile;
