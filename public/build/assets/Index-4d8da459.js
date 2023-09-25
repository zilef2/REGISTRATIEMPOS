import{l as j,K as I,m as B,O as D,p as U,f as l,a as p,u as m,w as _,F as h,q as F,o as t,Z as A,b as s,c as u,d as E,t as c,g as d,k,s as w,x as T,v as x}from"./app-f2326059.js";import{_ as q,a as K}from"./AuthenticatedLayout-1ea82094.js";import{a as L}from"./TextInput-235477d9.js";import{_ as M}from"./PrimaryButton-8575f0a0.js";import{_ as R}from"./SelectInput-23af0470.js";import{_ as Z}from"./DangerButton-586fa28f.js";import{_ as z,a as G,r as H}from"./Pagination-fa79fde8.js";import J from"./Create-65c032c9.js";import Q from"./Edit-2eda5a29.js";import W from"./Delete-a8dfa929.js";import{_ as X}from"./Checkbox-0cd023d4.js";import{_ as Y,r as ee}from"./InfoButton-83385bd7.js";import{n as v,f as S}from"./global-b0d05eda.js";import"./index-b74043ae.js";import"./InputError-111b2d05.js";import"./SecondaryButton-06ec2122.js";import"./vue-select-6d992ad4.js";import"./vue-datepicker-29ed76b2.js";/* empty css             */const te={class:"space-y-4"},se={class:"px-4 sm:px-0"},re={class:"rounded-lg overflow-hidden w-fit"},oe={class:"relative bg-white dark:bg-gray-800 shadow sm:rounded-lg"},ae={class:"flex justify-between p-2"},ne={class:"flex space-x-2"},le={class:"overflow-x-auto scrollbar-table"},ie={key:0,class:"w-full"},de={class:"uppercase text-sm border-t border-gray-200 dark:border-gray-700"},ce={class:"dark:bg-gray-900/50 text-left"},pe={class:"px-2 py-4 text-center"},me={key:0,class:"px-2 py-4"},ue=s("th",{class:"px-2 py-4 text-center"},"#",-1),fe=["onClick"],be={class:"flex justify-between items-center"},ye={class:"whitespace-nowrap py-4 px-2 sm:py-3 text-center"},_e=["value"],he={key:0,class:"whitespace-nowrap py-4 w-12 px-2 sm:py-3"},ge={class:"flex justify-center items-center"},ke={class:"rounded-md overflow-hidden"},we={class:"whitespace-nowrap py-4 px-2 sm:py-3 text-center"},xe={class:"whitespace-nowrap py-4 px-2 sm:py-3"},ve={key:0},Se={key:1},$e={key:2},Pe={key:3},Ce={key:4},Oe={key:5},Ve={class:"border-t border-gray-600"},Ne={key:0,class:"whitespace-nowrap py-4 w-12 px-2 sm:py-3 text-center"},je=s("td",{class:"whitespace-nowrap py-4 px-2 sm:py-3 text-center"}," Total: ",-1),Ie={class:"whitespace-nowrap py-4 px-2 sm:py-3 text-center"},Be={key:1,class:"text-center text-xl my-8"},De={key:0,class:"flex justify-between items-center p-2 border-t border-gray-200 dark:border-gray-700"},et={__name:"Index",props:{fromController:Object,total:Number,filters:Object,breadcrumbs:Object,perPage:Number,title:String,numberPermissions:Number,Flash:String},setup(f){const o=f,{_:$,debounce:P,pickBy:C}=F,e=j({params:{search:o.filters.search,field:o.filters.field,order:o.filters.order,perPage:o.perPage},generico:null,selectedId:[],multipleSelect:!1,createOpen:!1,editOpen:!1,deleteOpen:!1,dataSet:I().props.app.perpage}),O=a=>{e.params.field=a,e.params.order=e.params.order==="asc"?"desc":"asc"};B(()=>$.cloneDeep(e.params),P(()=>{let a=C(e.params);D.get(route("disponibilidad.index"),a,{replace:!0,preserveState:!0,preserveScroll:!0})},150));const V=a=>{var n;a.target.checked===!1?e.selectedId=[]:(n=o.disponibilidads)==null||n.data.forEach(y=>{e.selectedId.push(y.id)})},N=()=>{var a;((a=o.disponibilidads)==null?void 0:a.data.length)==e.selectedId.length?e.multipleSelect=!0:e.multipleSelect=!1},b=[{order:"nombre",label:"nombre",type:"text"},{order:"centros",label:"centros",type:"text"}];return(a,n)=>{const y=U("tooltip");return t(),l(h,null,[p(m(A),{title:o.title},null,8,["title"]),p(q,null,{default:_(()=>[p(K,{title:f.title,breadcrumbs:f.breadcrumbs},null,8,["title","breadcrumbs"]),s("div",te,[s("div",se,[s("div",re,[a.can(["create disponibilidad"])?(t(),u(M,{key:0,class:"rounded-none",onClick:n[0]||(n[0]=r=>e.createOpen=!0)},{default:_(()=>[E(c(a.lang().button.add),1)]),_:1})):d("",!0),a.can(["create disponibilidad"])?(t(),u(J,{key:1,numberPermissions:o.numberPermissions,titulos:b,show:e.createOpen,onClose:n[1]||(n[1]=r=>e.createOpen=!1),title:o.title,losSelect:o.losSelect},null,8,["numberPermissions","show","title","losSelect"])):d("",!0),a.can(["update disponibilidad"])?(t(),u(Q,{key:2,titulos:b,numberPermissions:o.numberPermissions,show:e.editOpen,onClose:n[2]||(n[2]=r=>e.editOpen=!1),generica:e.generico,title:o.title,losSelect:o.losSelect},null,8,["numberPermissions","show","generica","title","losSelect"])):d("",!0),a.can(["delete disponibilidad"])?(t(),u(W,{key:3,numberPermissions:o.numberPermissions,show:e.deleteOpen,onClose:n[3]||(n[3]=r=>e.deleteOpen=!1),generica:e.generico,title:o.title},null,8,["numberPermissions","show","generica","title"])):d("",!0)])]),s("div",oe,[s("div",ae,[s("div",ne,[p(R,{modelValue:e.params.perPage,"onUpdate:modelValue":n[4]||(n[4]=r=>e.params.perPage=r),dataSet:e.dataSet},null,8,["modelValue","dataSet"])]),o.numberPermissions>1?(t(),u(L,{key:0,modelValue:e.params.search,"onUpdate:modelValue":n[5]||(n[5]=r=>e.params.search=r),type:"text",class:"block w-4/6 md:w-3/6 lg:w-2/6 rounded-lg",placeholder:"Nombre, codigo"},null,8,["modelValue"])):d("",!0)]),s("div",le,[o.total>0?(t(),l("table",ie,[s("thead",de,[s("tr",ce,[s("th",pe,[p(X,{checked:e.multipleSelect,"onUpdate:checked":n[6]||(n[6]=r=>e.multipleSelect=r),onChange:V},null,8,["checked"])]),f.numberPermissions>1?(t(),l("th",me,"Accion")):d("",!0),ue,(t(),l(h,null,k(b,r=>s("th",{class:"px-2 py-4 cursor-pointer",onClick:g=>O(r.order)},[s("div",be,[s("span",null,c(a.lang().label[r.label]),1),p(m(G),{class:"w-4 h-4"})])],8,fe)),64))])]),s("tbody",null,[(t(!0),l(h,null,k(o.fromController.data,(r,g)=>(t(),l("tr",{key:g,class:"border-t border-gray-200 dark:border-gray-700 hover:bg-gray-200/30 hover:dark:bg-gray-900/20"},[s("td",ye,[w(s("input",{class:"rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-primary dark:text-primary shadow-sm focus:ring-primary/80 dark:focus:ring-primary dark:focus:ring-offset-gray-800 dark:checked:bg-primary dark:checked:border-primary",type:"checkbox",onChange:N,value:r.id,"onUpdate:modelValue":n[7]||(n[7]=i=>e.selectedId=i)},null,40,_e),[[T,e.selectedId]])]),f.numberPermissions>1?(t(),l("td",he,[s("div",ge,[s("div",ke,[w((t(),u(Y,{type:"button",onClick:i=>(e.editOpen=!0,e.generico=r),class:"px-2 py-1.5 rounded-none"},{default:_(()=>[p(m(ee),{class:"w-4 h-4"})]),_:2},1032,["onClick"])),[[x,a.can(["update user"])],[y,a.lang().tooltip.edit]]),w((t(),u(Z,{type:"button",onClick:i=>(e.deleteOpen=!0,e.generico=r),class:"px-2 py-1.5 rounded-none"},{default:_(()=>[p(m(H),{class:"w-4 h-4"})]),_:2},1032,["onClick"])),[[x,a.can(["delete user"])],[y,a.lang().tooltip.delete]])])])])):d("",!0),s("td",we,c(++g),1),(t(),l(h,null,k(b,i=>s("td",xe,[i.type=="text"?(t(),l("span",ve,c(r[i.order]),1)):d("",!0),i.type=="number"?(t(),l("span",Se,c(m(v)(r[i.order],0,!1)),1)):d("",!0),i.type=="dinero"?(t(),l("span",$e,c(m(v)(r[i.order],0,!0)),1)):d("",!0),i.type=="date"?(t(),l("span",Pe,c(m(S)(r[i.order],!1)),1)):d("",!0),i.type=="datetime"?(t(),l("span",Ce,c(m(S)(r[i.order],!0)),1)):d("",!0),i.type=="foreign"?(t(),l("span",Oe,c(r[i.nameid]),1)):d("",!0)])),64))]))),128)),s("tr",Ve,[f.numberPermissions>1?(t(),l("td",Ne," - ")):d("",!0),je,s("td",Ie,c(o.total),1)])])])):(t(),l("h2",Be,"Sin Registros"))]),o.total>0?(t(),l("div",De,[p(z,{links:o.fromController,filters:e.params},null,8,["links","filters"])])):d("",!0)])])]),_:1})],64)}}};export{et as default};
