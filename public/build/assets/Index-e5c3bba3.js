import{l as j,K as I,m as B,O as D,p as U,f as n,a as p,u as m,w as b,F as h,q as F,o as t,Z as A,b as s,c as u,d as E,t as c,g as d,k,s as w,x as T,v as x}from"./app-f2326059.js";import{_ as q,a as K}from"./AuthenticatedLayout-1ea82094.js";import{a as L}from"./TextInput-235477d9.js";import{_ as M}from"./PrimaryButton-8575f0a0.js";import{_ as R}from"./SelectInput-23af0470.js";import{_ as Z}from"./DangerButton-586fa28f.js";import{_ as z,a as G,r as H}from"./Pagination-fa79fde8.js";import J from"./Create-d02926b6.js";import Q from"./Edit-671c4278.js";import W from"./Delete-be11af77.js";import{_ as X}from"./Checkbox-0cd023d4.js";import{_ as Y,r as ee}from"./InfoButton-83385bd7.js";import{n as v,f as S}from"./global-b0d05eda.js";import"./index-b74043ae.js";import"./InputError-111b2d05.js";import"./SecondaryButton-06ec2122.js";import"./vue-select-6d992ad4.js";import"./vue-datepicker-29ed76b2.js";/* empty css             */const te={class:"space-y-4"},se={class:"px-4 sm:px-0"},re={class:"rounded-lg overflow-hidden w-fit"},ae={class:"relative bg-white dark:bg-gray-800 shadow sm:rounded-lg"},oe={class:"flex justify-between p-2"},le={class:"flex space-x-2"},ne={class:"overflow-x-auto scrollbar-table"},ie={key:0,class:"w-full"},de={class:"uppercase text-sm border-t border-gray-200 dark:border-gray-700"},ce={class:"dark:bg-gray-900/50 text-left"},pe={class:"px-2 py-4 text-center"},me={key:0,class:"px-2 py-4"},ue=s("th",{class:"px-2 py-4 text-center"},"#",-1),fe=["onClick"],ye={class:"flex justify-between items-center"},_e={class:"whitespace-nowrap py-4 px-2 sm:py-3 text-center"},be=["value"],he={key:0,class:"whitespace-nowrap py-4 w-12 px-2 sm:py-3"},ge={class:"flex justify-center items-center"},ke={class:"rounded-md overflow-hidden"},we={class:"whitespace-nowrap py-4 px-2 sm:py-3 text-center"},xe={class:"whitespace-nowrap py-4 px-2 sm:py-3"},ve={key:0},Se={key:1},$e={key:2},Pe={key:3},Ce={key:4},Oe={key:5},Ve={class:"border-t border-gray-600"},Ne={key:0,class:"whitespace-nowrap py-4 w-12 px-2 sm:py-3 text-center"},je=s("td",{class:"whitespace-nowrap py-4 px-2 sm:py-3 text-center"}," Total: ",-1),Ie={class:"whitespace-nowrap py-4 px-2 sm:py-3 text-center"},Be={key:1,class:"text-center text-xl my-8"},De={key:0,class:"flex justify-between items-center p-2 border-t border-gray-200 dark:border-gray-700"},et={__name:"Index",props:{fromController:Object,total:Number,filters:Object,breadcrumbs:Object,perPage:Number,title:String,numberPermissions:Number,Flash:String},setup(f){const a=f,{_:$,debounce:P,pickBy:C}=F,e=j({params:{search:a.filters.search,field:a.filters.field,order:a.filters.order,perPage:a.perPage},generico:null,selectedId:[],multipleSelect:!1,createOpen:!1,editOpen:!1,deleteOpen:!1,dataSet:I().props.app.perpage}),O=o=>{e.params.field=o,e.params.order=e.params.order==="asc"?"desc":"asc"};B(()=>$.cloneDeep(e.params),P(()=>{let o=C(e.params);D.get(route("material.index"),o,{replace:!0,preserveState:!0,preserveScroll:!0})},150));const V=o=>{var l;o.target.checked===!1?e.selectedId=[]:(l=a.materials)==null||l.data.forEach(_=>{e.selectedId.push(_.id)})},N=()=>{var o;((o=a.materials)==null?void 0:o.data.length)==e.selectedId.length?e.multipleSelect=!0:e.multipleSelect=!1},y=[{order:"nombre",label:"nombre",type:"text"}];return(o,l)=>{const _=U("tooltip");return t(),n(h,null,[p(m(A),{title:a.title},null,8,["title"]),p(q,null,{default:b(()=>[p(K,{title:f.title,breadcrumbs:f.breadcrumbs},null,8,["title","breadcrumbs"]),s("div",te,[s("div",se,[s("div",re,[o.can(["create material"])?(t(),u(M,{key:0,class:"rounded-none",onClick:l[0]||(l[0]=r=>e.createOpen=!0)},{default:b(()=>[E(c(o.lang().button.add),1)]),_:1})):d("",!0),o.can(["create material"])?(t(),u(J,{key:1,numberPermissions:a.numberPermissions,titulos:y,show:e.createOpen,onClose:l[1]||(l[1]=r=>e.createOpen=!1),title:a.title,losSelect:a.losSelect},null,8,["numberPermissions","show","title","losSelect"])):d("",!0),o.can(["update material"])?(t(),u(Q,{key:2,titulos:y,numberPermissions:a.numberPermissions,show:e.editOpen,onClose:l[2]||(l[2]=r=>e.editOpen=!1),generica:e.generico,title:a.title,losSelect:a.losSelect},null,8,["numberPermissions","show","generica","title","losSelect"])):d("",!0),o.can(["delete material"])?(t(),u(W,{key:3,numberPermissions:a.numberPermissions,show:e.deleteOpen,onClose:l[3]||(l[3]=r=>e.deleteOpen=!1),generica:e.generico,title:a.title},null,8,["numberPermissions","show","generica","title"])):d("",!0)])]),s("div",ae,[s("div",oe,[s("div",le,[p(R,{modelValue:e.params.perPage,"onUpdate:modelValue":l[4]||(l[4]=r=>e.params.perPage=r),dataSet:e.dataSet},null,8,["modelValue","dataSet"])]),a.numberPermissions>1?(t(),u(L,{key:0,modelValue:e.params.search,"onUpdate:modelValue":l[5]||(l[5]=r=>e.params.search=r),type:"text",class:"block w-4/6 md:w-3/6 lg:w-2/6 rounded-lg",placeholder:"Nombre, codigo"},null,8,["modelValue"])):d("",!0)]),s("div",ne,[a.total>0?(t(),n("table",ie,[s("thead",de,[s("tr",ce,[s("th",pe,[p(X,{checked:e.multipleSelect,"onUpdate:checked":l[6]||(l[6]=r=>e.multipleSelect=r),onChange:V},null,8,["checked"])]),f.numberPermissions>1?(t(),n("th",me,"Accion")):d("",!0),ue,(t(),n(h,null,k(y,r=>s("th",{class:"px-2 py-4 cursor-pointer",onClick:g=>O(r.order)},[s("div",ye,[s("span",null,c(o.lang().label[r.label]),1),p(m(G),{class:"w-4 h-4"})])],8,fe)),64))])]),s("tbody",null,[(t(!0),n(h,null,k(a.fromController.data,(r,g)=>(t(),n("tr",{key:g,class:"border-t border-gray-200 dark:border-gray-700 hover:bg-gray-200/30 hover:dark:bg-gray-900/20"},[s("td",_e,[w(s("input",{class:"rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-primary dark:text-primary shadow-sm focus:ring-primary/80 dark:focus:ring-primary dark:focus:ring-offset-gray-800 dark:checked:bg-primary dark:checked:border-primary",type:"checkbox",onChange:N,value:r.id,"onUpdate:modelValue":l[7]||(l[7]=i=>e.selectedId=i)},null,40,be),[[T,e.selectedId]])]),f.numberPermissions>1?(t(),n("td",he,[s("div",ge,[s("div",ke,[w((t(),u(Y,{type:"button",onClick:i=>(e.editOpen=!0,e.generico=r),class:"px-2 py-1.5 rounded-none"},{default:b(()=>[p(m(ee),{class:"w-4 h-4"})]),_:2},1032,["onClick"])),[[x,o.can(["update user"])],[_,o.lang().tooltip.edit]]),w((t(),u(Z,{type:"button",onClick:i=>(e.deleteOpen=!0,e.generico=r),class:"px-2 py-1.5 rounded-none"},{default:b(()=>[p(m(H),{class:"w-4 h-4"})]),_:2},1032,["onClick"])),[[x,o.can(["delete user"])],[_,o.lang().tooltip.delete]])])])])):d("",!0),s("td",we,c(++g),1),(t(),n(h,null,k(y,i=>s("td",xe,[i.type=="text"?(t(),n("span",ve,c(r[i.order]),1)):d("",!0),i.type=="number"?(t(),n("span",Se,c(m(v)(r[i.order],0,!1)),1)):d("",!0),i.type=="dinero"?(t(),n("span",$e,c(m(v)(r[i.order],0,!0)),1)):d("",!0),i.type=="date"?(t(),n("span",Pe,c(m(S)(r[i.order],!1)),1)):d("",!0),i.type=="datetime"?(t(),n("span",Ce,c(m(S)(r[i.order],!0)),1)):d("",!0),i.type=="foreign"?(t(),n("span",Oe,c(r[i.nameid]),1)):d("",!0)])),64))]))),128)),s("tr",Ve,[f.numberPermissions>1?(t(),n("td",Ne," - ")):d("",!0),je,s("td",Ie,c(a.total),1)])])])):(t(),n("h2",Be,"Sin Registros"))]),a.total>0?(t(),n("div",De,[p(z,{links:a.fromController,filters:e.params},null,8,["links","filters"])])):d("",!0)])])]),_:1})],64)}}};export{et as default};
