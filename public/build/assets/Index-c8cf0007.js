import{l as g,m as k,O as x,p as O,f as p,a,u as n,w as u,F as _,q as S,o as d,Z as C,b as e,s as c,v as m,k as $,c as j,t as f}from"./app-fc6cbe82.js";import{_ as B,a as D}from"./AuthenticatedLayout-1e6a5edb.js";import F from"./Create-2f441a3a.js";import P from"./Edit-70b05181.js";import I from"./Delete-d7602a87.js";import{r as N,_ as T}from"./InfoButton-70e980a4.js";import{f as V,P as q}from"./global-2e02be81.js";import"./index-ed412522.js";import"./InputError-5608eb67.js";import"./TextInput-2923ad7e.js";import"./SecondaryButton-f81a2274.js";import"./PrimaryButton-b2522f86.js";import"./SelectInput-e2662186.js";import"./DangerButton-37c79524.js";const A={class:"space-y-4"},E={class:"px-4 sm:px-0"},L={class:"rounded-lg overflow-hidden w-fit"},Z={class:"relative bg-white dark:bg-gray-800 shadow sm:rounded-lg"},z=e("div",{class:"flex justify-between p-2"},[e("div",{class:"flex space-x-2"})],-1),G={class:"overflow-x-auto scrollbar-table"},H={class:"w-full"},J={class:"uppercase text-sm border-t border-gray-200 dark:border-gray-700"},K={class:"dark:bg-gray-900 text-left"},M={class:"flex justify-between items-center"},Q={class:"border-t border-gray-200 dark:border-gray-700 hover:bg-gray-200/30 hover:dark:bg-gray-900/20"},R={class:"whitespace-nowrap py-4 px-2 sm:py-3"},U={class:"flex justify-start items-center"},W={class:"rounded-md overflow-hidden"},X={class:"whitespace-nowrap py-4 px-2 sm:py-3"},Y={class:"whitespace-nowrap py-4 px-2 sm:py-3"},ue={__name:"Index",props:{title:String,filters:Object,breadcrumbs:Object,fromController:Object,nombresTabla:Array},setup(i){const t=i,{_:b,debounce:h,pickBy:v}=S,r=g({params:{search:t.filters.search,field:t.filters.field,order:t.filters.order},selectedId:[],createOpen:!1,editOpen:!1,deleteOpen:!1,generico:null});return k(()=>b.cloneDeep(r.params),h(()=>{let o=v(r.params);x.get(route("parametro.index"),o,{replace:!0,preserveState:!0,preserveScroll:!0})},150)),(o,s)=>{const y=O("tooltip");return d(),p(_,null,[a(n(C),{title:t.title},null,8,["title"]),a(B,null,{default:u(()=>[a(D,{title:i.title,breadcrumbs:i.breadcrumbs},null,8,["title","breadcrumbs"]),e("div",A,[e("div",E,[e("div",L,[c(a(F,{show:r.createOpen,onClose:s[0]||(s[0]=l=>r.createOpen=!1),title:t.title,parametrosSelect:r.parametrosSelect},null,8,["show","title","parametrosSelect"]),[[m,o.can(["create parametro"])]]),c(a(P,{show:r.editOpen,onClose:s[1]||(s[1]=l=>r.editOpen=!1),parametro:t.fromController,title:t.title,parametrosSelect:r.parametrosSelect},null,8,["show","parametro","title","parametrosSelect"]),[[m,o.can(["edit parametro"])]]),c(a(I,{show:r.deleteOpen,onClose:s[2]||(s[2]=l=>r.deleteOpen=!1),parametro:t.fromController,title:t.title},null,8,["show","parametro","title"]),[[m,o.can(["delete parametro"])]])])]),e("div",Z,[z,e("div",G,[e("table",H,[e("thead",J,[e("tr",K,[(d(!0),p(_,null,$(i.nombresTabla[0],(l,w)=>(d(),p("th",{key:w,class:"px-2 py-4 cursor-pointer hover:bg-sky-50 dark:hover:bg-sky-800"},[e("div",M,[e("span",null,f(l),1)])]))),128))])]),e("tbody",null,[e("tr",Q,[e("td",R,[e("div",U,[e("div",W,[c((d(),j(T,{type:"button",onClick:s[3]||(s[3]=l=>r.editOpen=!0),class:"px-2 py-1.5 rounded-none"},{default:u(()=>[a(n(N),{class:"w-4 h-4"})]),_:1})),[[y,o.lang().tooltip.edit]])])])]),e("td",X,f(n(V)(t.fromController.Fecha_creacion_parametro,!1)),1),e("td",Y,f(n(q)(t.fromController.nombre,20)),1)])])])])])])]),_:1})],64)}}};export{ue as default};