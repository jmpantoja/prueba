import {Context} from "@nuxt/types";
import {Security} from "~/types/security";

export default (context: Context, inject: Function) => {
  const security = new Security(context);
  context.security = security
  inject('security', security)
}
