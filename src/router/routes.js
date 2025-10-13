import RootComponent from "@/pages/App/RootComponent.vue";
import SEditFornecedorComponent from "@/pages/Stockly/Inside/fornecedor/SEditFornecedorComponent.vue";
import SFornecedorComponent from "@/pages/Stockly/Inside/fornecedor/SFornecedorComponent.vue";
import SHomeComponent from "@/pages/Stockly/Inside/SHomeComponent.vue";
import SRootComponent from "@/pages/Stockly/Inside/SRootComponent.vue";
import SLoginComponent from "@/pages/Stockly/SLoginComponent.vue";

export const routes = [
  {
    path: "/",
    component: RootComponent,
  },
  {
    path: "/stockly",
    component: SLoginComponent
  },
  {
    path: "/stockly/app",
    component: SRootComponent,
    children: [
      {
        path: "home",
        name: "appHome",
        component: SHomeComponent
      },
      {
        path: "fornecedor",
        name: "homeFornecedor",
        component: SFornecedorComponent,
        children: [
          {
            path: "editar/:nome",
            component: SEditFornecedorComponent
          }
        ]
      }
    ]
  }
];