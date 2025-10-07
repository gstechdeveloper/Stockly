import RootComponent from "@/pages/App/RootComponent.vue";
import SLoginComponent from "@/pages/Stockly/SLoginComponent.vue";

export const routes = [
  {
    path: "/",
    component: RootComponent,
  },
  {
    path: "/stockly",
    component: SLoginComponent
  }
];