import{l as k,T as I,E as D,f as d,a,u as t,w as h,F as U,o as c,Z as E,b as e,t as i,g as u,e as v,s as b,v as f,n as _,d as r}from"./app-074b46c7.js";import{_ as C,a as N}from"./AuthenticatedLayout-17ebc6d8.js";import{_ as x}from"./PrimaryButton-898ad35f.js";import{_ as $}from"./SelectInput-cd179d42.js";import{_ as z}from"./InputError-56ccfaaa.js";import"./vue-datepicker-f30b8365.js";/* empty css             */import{v as F}from"./global-c34cc242.js";import{r as w}from"./ArrowUpCircleIcon-e67bb9e1.js";import"./index-38a1cebf.js";const V={class:"space-y-4"},B={key:0,class:"px-4 sm:px-0"},L={class:"rounded-lg overflow-hidden w-fit"},M={class:"flex max-w-screen-xl shadow-lg rounded-lg"},O=e("div",{class:"bg-yellow-600 py-4 px-6 rounded-l-lg flex items-center"},[e("svg",{xmlns:"http://www.w3.org/2000/svg",viewBox:"0 0 16 16",class:"fill-current text-white",width:"20",height:"20"},[e("path",{"fill-rule":"evenodd",d:"M8.22 1.754a.25.25 0 00-.44 0L1.698 13.132a.25.25 0 00.22.368h12.164a.25.25 0 00.22-.368L8.22 1.754zm-1.763-.707c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0114.082 15H1.918a1.75 1.75 0 01-1.543-2.575L6.457 1.047zM9 11a1 1 0 11-2 0 1 1 0 012 0zm-.25-5.25a.75.75 0 00-1.5 0v2.5a.75.75 0 001.5 0v-2.5z"})])],-1),T={class:"px-8 py-6 bg-white rounded-r-lg flex justify-between items-center w-full border border-l-transparent border-gray-200"},q={class:"relative bg-white dark:bg-gray-800 shadow sm:rounded-lg"},A={class:"text-gray-600 body-font"},H={class:"container px-5 py-24 mx-auto"},P={key:0,class:"flex flex-wrap -m-4"},Z={class:"p-4 md:w-1/2"},G={class:"h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden"},J={class:"p-6"},K=e("h3",{class:"title-font text-lg font-medium text-gray-900 mb-3"},"Subir trabajadors",-1),Q=e("p",{class:"leading-relaxed mb-3"}," Este formulario solo permite cargar trabajadors",-1),R=["onSubmit"],W=["value"],X=e("h2",{class:"text-xl text-gray-900 dark:text-white"},"El formato necesita las siguientes columnas",-1),Y=e("ul",{class:"list-decimal my-6 mx-5"},[e("li",{class:"text-lg"},"Nombre"),e("li",{class:"text-lg"},[r("Correo: "),e("small",{class:"text-lg"},"Cada correo debe ser unico")]),e("li",{class:"text-lg"},[r("Identificacion: "),e("small",{class:"text-lg"},"Debe ser un numero")]),e("li",{class:"text-lg"},[r("Sexo: "),e("small",{class:"text-lg"},"Femenino, masculino u otro")]),e("li",{class:"text-lg"},"Fecha de nacimiento"),e("li",{class:"text-lg"},"Semestre"),e("li",{class:"text-lg"},[r("Nivel: "),e("small",{class:"text-lg"},"Primaria, bachillerato, tecnologia, profesional,especializacion,maestría,doctorado")]),e("li",{class:"text-lg"},[r("Cargo: "),e("small",{class:"text-lg"},"trabajador, profesor")])],-1),ee={class:"flex items-center flex-wrap my-6"},se=e("a",{class:"text-gray-500 inline-flex items-center md:mb-2 lg:mb-0"},"Numero de Usuarios: ",-1),te={class:"text-gray-400 mr-3 inline-flex items-center lg:ml-auto md:ml-0 ml-auto leading-none text-sm pr-3 py-1 border-r-2 border-gray-200"},ae=e("svg",{class:"w-1 h-4 mr-1",stroke:"currentColor","stroke-width":"2",fill:"none","stroke-linecap":"round","stroke-linejoin":"round",viewBox:"0 0 24 24"},[e("path",{d:"M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"}),e("circle",{cx:"12",cy:"12",r:"3"})],-1),le={class:"p-4 md:w-1/2"},re={class:"h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden"},oe={class:"p-6"},ie=e("h3",{class:"title-font text-lg font-medium text-gray-900 mb-3"},"Subir trabajadors",-1),ne=e("p",{class:"leading-relaxed mb-3"}," Este formulario solo permite cargar trabajadors",-1),de=["onSubmit"],ce=["value"],ue=e("h2",{class:"text-xl text-gray-900 dark:text-white"},"El formato necesita las siguientes columnas",-1),me=e("ul",{class:"list-decimal my-6 mx-5"},[e("li",{class:"text-lg"},"Identificacion : del trabajador a inscribir")],-1),Se={__name:"subirExceles",props:{title:String,breadcrumbs:Object,numUsuarios:Number,UniversidadSelect:Object},setup(m){const p=m,g=k({UniversidadSelect:null}),s=I({archivo1:null,universidadID:0});function y(){s.post(route("user.uploadtrabajadors"),{preserveScroll:!0,onSuccess:()=>{},onError:()=>null,onFinish:()=>null})}function S(){s.universidadID===null||s.universidadID===0?(console.log("🧈 debu form.universidadID:",s.universidadID),alert("Seleccione la universidad")):s.post(route("user.uploadUniversidad"),{preserveScroll:!0,onSuccess:()=>{},onError:()=>null,onFinish:()=>null})}return g.UniversidadSelect=F(g.UniversidadSelect,p.UniversidadSelect,"una"),(l,o)=>{const j=D("InputLabel");return c(),d(U,null,[a(t(E),{title:p.title},null,8,["title"]),a(C,null,{default:h(()=>[a(N,{title:m.title,breadcrumbs:m.breadcrumbs},null,8,["title","breadcrumbs"]),e("div",V,[l.$page.props.flash.warning?(c(),d("div",B,[e("div",L,[e("div",M,[O,e("div",T,[e("div",null,i(l.$page.props.flash.warning?l.$page.props.flash.warning:""),1)])])])])):u("",!0),e("div",q,[e("section",A,[e("div",H,[l.can(["create user"])?(c(),d("div",P,[e("div",Z,[e("div",G,[a(t(w),{class:"h-24 lg:h-48 md:h-36 w-full object-cover object-center"}),e("div",J,[K,Q,e("form",{onSubmit:v(y,["prevent"]),id:"upload"},[e("input",{type:"file",onInput:o[0]||(o[0]=n=>t(s).archivo1=n.target.files[0]),accept:"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"},null,32),t(s).progress?(c(),d("progress",{key:0,value:t(s).progress.percentage,max:"100",class:"bg-sky-200"},i(t(s).progress.percentage)+"% ",9,W)):u("",!0),b(a(x,{disabled:t(s).archivo1==null,class:_(["rounded-none my-4",{"bg-gray-200":t(s).archivo1==null}])},{default:h(()=>[r(i(l.lang().button.subir),1)]),_:1},8,["disabled","class"]),[[f,l.can(["create user"])]])],40,R),X,Y,e("div",ee,[se,e("span",te,[ae,r(" "+i(p.numUsuarios),1)])])])])]),e("div",le,[e("div",re,[a(t(w),{class:"h-24 lg:h-48 md:h-36 w-full object-cover object-center"}),e("div",oe,[ie,ne,e("form",{onSubmit:v(S,["prevent"]),id:"upload"},[e("div",null,[a(j,{for:"universidadID",value:l.lang().label.carrera},null,8,["value"]),a($,{id:"universidadID",class:"mt-1 block w-full",modelValue:t(s).universidadID,"onUpdate:modelValue":o[1]||(o[1]=n=>t(s).universidadID=n),required:"",dataSet:g.UniversidadSelect},null,8,["modelValue","dataSet"]),a(z,{class:"mt-2",message:t(s).errors.universidadID},null,8,["message"])]),e("input",{type:"file",onInput:o[2]||(o[2]=n=>t(s).archivo1=n.target.files[0]),accept:"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"},null,32),t(s).progress?(c(),d("progress",{key:0,value:t(s).progress.percentage,max:"100",class:"bg-sky-200"},i(t(s).progress.percentage)+"% ",9,ce)):u("",!0),b(a(x,{disabled:t(s).archivo1==null,class:_(["rounded-none my-4 mx-4",{"bg-gray-200":t(s).archivo1==null}])},{default:h(()=>[r(i(l.lang().button.subir),1)]),_:1},8,["disabled","class"]),[[f,l.can(["create user"])]])],40,de),ue,me])])])])):u("",!0)])])])])]),_:1})],64)}}};export{Se as default};
