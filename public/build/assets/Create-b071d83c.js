import{l as N,T as A,D as U,y as E,m as V,f as n,a as s,w as x,o as c,b as d,t as _,u as o,g as m,d as k,n as B,e as z}from"./app-dd94624b.js";import{_ as p}from"./InputError-99b22b36.js";import{_ as j,a as f}from"./TextInput-421a4c9d.js";import{_ as D,a as I}from"./SecondaryButton-320d8f83.js";import{_ as $}from"./PrimaryButton-f5a76b26.js";import{C as u}from"./vue-select-a04d1989.js";import{T as F,a as G}from"./global-32514258.js";/* empty css             */const M={class:"space-y-6"},q=["onSubmit"],P={class:"text-lg font-medium text-gray-900 dark:text-gray-100"},X={class:"grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4 gap-6"},J={key:0,id:"opcinesActividadO",class:"xl:col-span-2 col-span-1"},W=d("label",{name:""}," Reportar en nombre de: ",-1),H={id:"opcinesActividadO",class:"xl:col-span-2 col-span-1"},K=d("label",{name:""}," Tipo de reporte ",-1),L={class:"xl:col-span-1 col-span-1"},Q={class:"col-span-1"},Y={key:1,id:"Sordentrabajo",class:"xl:col-span-2 col-span-1"},Z=d("label",{name:"ordentrabajo_ids"}," Orden de trabajo ",-1),ee={key:2,class:"w-full lg:col-span-2 col-span-1"},oe={key:3,class:"w-full col-span-1"},ae={id:"Scentrotrabajo",class:"col-span-1"},ie=d("label",{name:"centrotrabajo_id"}," Centro de trabajo ",-1),te={key:4,class:"col-span-1"},le={key:5,id:"actividad",class:"xl:col-span-2 col-span-1"},se=d("label",{name:"actividad_id"}," Actividad ",-1),de={key:6,id:"reproceso",class:"xl:col-span-2 col-span-1"},re=d("label",{name:"reproceso_id"}," Reproceso",-1),ne={key:7,id:"disponibilidad",class:"xl:col-span-3 col-span-1"},ce=d("label",{name:"disponibilidad_id"}," Disponibilidad",-1),me={class:"mb-8 mt-[360px] flex justify-end"},pe={key:0,class:"mx-12 px-8 text-lg font-medium text-red-600 bg-red-50 dark:text-gray-100"},ue={key:1,class:"mx-12 px-8 text-lg font-medium text-gray-800 dark:text-gray-100"},Ve={__name:"Create",props:{show:Boolean,title:String,roles:Object,losSelect:Object,numberPermissions:Number,valuesGoogleCabeza:Object,valuesGoogleBody:Object,Trabajadores:Object},emits:["close"],setup(w,{emit:g}){const r=w,t=N({params:{pregunta:""},actividad_id:r.losSelect.actividad,centrotrabajo_id:r.losSelect.centrotrabajo,disponibilidad_id:r.losSelect.disponibilidad,ordentrabajo_id:r.losSelect.ordentrabajo,reproceso_id:r.losSelect.reproceso,temp_disponibilidad_id:null,temp_reproceso_id:null,temp_actividad_id:null,valorInactivo:"NA",cabeza:r.valuesGoogleCabeza,nombresOT:Object.values(r.valuesGoogleBody),ordentrabajo_ids:[],mensajeFalta:"",BanderaTipo:!0,mensajeTiemposAuto:"",soloUnaVez:!0}),e=A({...Object.fromEntries(["tipoReporte","fecha","hora_inicial","hora_final","actividad_id","centrotrabajo_id","disponibilidad_id","operario_id","ordentrabajo_id","reproceso_id","ordentrabajo_ids","otitem","user_id","nombreTablero","OTItem","TiempoEstimado"].map(i=>[i,""]))});U(()=>{r.numberPermissions>9&&setTimeout(()=>{e.ordentrabajo_ids=t.ordentrabajo_ids[1],e.centrotrabajo_id=t.centrotrabajo_id[1],e.actividad_id=t.actividad_id[1],t.mensajeTiemposAuto="Super!"},900)});const b=["Tiempo_estimado_corte","Tiempo_estimado_doblez","Tiempo_estimado_soldadura","Tiempo_estimado_pulida","Tiempo_estimado_ensamble","Tiempo_estimado_cobre","Tiempo_estimado_cableado","Tiempo_estimado_Ing_mec","Tiempo_estimado_Ing_elec"];function R(){let i=0;for(e.centrotrabajo_id=t.centrotrabajo_id[1];t.nombresOT[e.ordentrabajo_ids.value][b[i]]===""&&i<=b.length;)i++;e.TiempoEstimado=t.nombresOT[e.ordentrabajo_ids.value][b[i]],i!==b.length?(e.centrotrabajo_id=t.centrotrabajo_id[i+1],t.mensajeTiemposAuto=""):t.mensajeTiemposAuto="Tiempos vacios!",t.soloUnaVez=!1}E(()=>{if(r.show){if(t.BanderaTipo&&(e.tipoReporte={title:"Actividad",value:0},t.BanderaTipo=!1),e.errors={},e.fecha===null||e.fecha===""){let i=new Date;e.fecha=F(i).substring(0,10),e.hora_inicial=G(),t.ordentrabajo_ids=t.nombresOT.map((a,l)=>{var v;return{title:(v=a.Item)==null?void 0:v.replace(/_/g," "),value:l}})}if(e.ordentrabajo_ids&&e.ordentrabajo_ids.value!=null)if(e.nombreTablero=t.nombresOT[e.ordentrabajo_ids.value][y[0]],e.OTItem=t.nombresOT[e.ordentrabajo_ids.value].Item,t.soloUnaVez)R();else{let i=e.centrotrabajo_id.value-1;e.TiempoEstimado=t.nombresOT[e.ordentrabajo_ids.value][b[i]]}}else t.BanderaTipo=!0});let T=i=>{let a="";try{i.forEach((l,v)=>{if(typeof e[l]>"u"||e[l]===null||e[l].value===null||e[l].length===0)throw a=l,new Error("BreakException")})}catch{}return a},S=()=>{let i=e.tipoReporte.value,a=!0;const l=" es obligatorio";i==0&&(a=T(["ordentrabajo_ids","centrotrabajo_id","actividad_id"])),i==1&&(a=T(["centrotrabajo_id","ordentrabajo_ids","actividad_id","reproceso_id"])),i==2&&(a=T(["centrotrabajo_id","disponibilidad_id"]));let v={ordentrabajo_ids:"Orden trabajo",actividad_id:"Actividad",reproceso_id:"Reproceso",centrotrabajo_id:"Centro de trabajo",disponibilidad_id:"Disponibilidad"};return a!=""?v[a]+l:a};const O=()=>{e.ordentrabajo_id=e.ordentrabajo_ids,t.mensajeFalta=S(),t.mensajeFalta==""&&e.post(route("reporte.store"),{preserveScroll:!0,onSuccess:()=>{g("close"),e.reset()},onError:()=>alert(JSON.stringify(e.errors,null,4)),onFinish:()=>null})};V(()=>e.tipoReporte,i=>{e.actividad_id=null,e.centrotrabajo_id=null,e.disponibilidad_id=null,e.operario_id=null,e.ordentrabajo_id=null,e.reproceso_id=null,e.ordentrabajo_ids=null}),V(()=>e.ordentrabajo_ids,i=>{t.soloUnaVez=!0}),V(()=>e.centrotrabajo_id,i=>{if(i&&typeof i.value<"u"){let a="centrotrabajo"+i.title;t.actividad_id=r.losSelect[a]}e.actividad_id={title:"Seleccione actividad",value:null}});const C=[{title:"Actividad",value:0},{title:"Reproceso",value:1},{title:"Disponibilidad(paro)",value:2}],h=["Nombre Tablero","% avance","OT+Item","Tiempo estimado"],y=["Nombre_tablero","avance"];return(i,a)=>(c(),n("section",M,[s(D,{show:r.show,onClose:a[11]||(a[11]=l=>g("close")),maxWidth:"3xl"},{default:x(()=>[d("form",{class:"px-6 my-8",onSubmit:z(O,["prevent"])},[d("h2",P,_(i.lang().label.add)+" "+_(r.title),1),d("div",X,[r.numberPermissions>8?(c(),n("div",J,[W,s(o(u),{options:r.Trabajadores,label:"title",modelValue:o(e).user_id,"onUpdate:modelValue":a[0]||(a[0]=l=>o(e).user_id=l)},null,8,["options","modelValue"])])):m("",!0),d("div",H,[K,s(o(u),{options:C,label:"title",modelValue:o(e).tipoReporte,"onUpdate:modelValue":a[1]||(a[1]=l=>o(e).tipoReporte=l)},null,8,["modelValue"])]),d("div",L,[s(j,{for:"fecha",value:i.lang().label.fecha},null,8,["value"]),s(f,{id:"fecha",type:"date",class:"mt-1 block w-full bg-gray-200",modelValue:o(e).fecha,"onUpdate:modelValue":a[2]||(a[2]=l=>o(e).fecha=l),disabled:"",placeholder:"fecha",error:o(e).errors.fecha},null,8,["modelValue","error"]),s(p,{class:"mt-2",message:o(e).errors.fecha},null,8,["message"])]),d("div",Q,[s(j,{for:"hora_inicial",value:i.lang().label["hora inicial"]},null,8,["value"]),s(f,{id:"hora_inicial",type:"time",class:"mt-1 block w-full bg-gray-200",modelValue:o(e).hora_inicial,"onUpdate:modelValue":a[3]||(a[3]=l=>o(e).hora_inicial=l),disabled:"",placeholder:"hora_inicial",error:o(e).errors.hora_inicial,step:"3600"},null,8,["modelValue","error"]),s(p,{class:"mt-2",message:o(e).errors.hora_inicial},null,8,["message"])]),o(e).tipoReporte.value!=2?(c(),n("div",Y,[Z,s(o(u),{options:t.ordentrabajo_ids,label:"title",modelValue:o(e).ordentrabajo_ids,"onUpdate:modelValue":a[4]||(a[4]=l=>o(e).ordentrabajo_ids=l)},null,8,["options","modelValue"]),s(p,{class:"mt-2",message:o(e).errors.ordentrabajo_id},null,8,["message"])])):m("",!0),o(e).ordentrabajo_ids&&o(e).tipoReporte.value!=2?(c(),n("div",ee,[s(j,{for:i.index,value:h[0]},null,8,["for","value"]),s(f,{id:i.index,type:"text",disabled:"",class:"mt-1 block w-full bg-gray-200",value:t.nombresOT[o(e).ordentrabajo_ids.value][y[0]]},null,8,["id","value"])])):m("",!0),o(e).ordentrabajo_ids&&o(e).tipoReporte.value!=2?(c(),n("div",oe,[s(j,{for:i.index,value:h[1]},null,8,["for","value"]),s(f,{id:i.index,type:"text",disabled:"",class:"mt-1 block w-full bg-gray-200",value:t.nombresOT[o(e).ordentrabajo_ids.value][y[1]]},null,8,["id","value"])])):m("",!0),d("div",ae,[ie,s(o(u),{options:t.centrotrabajo_id,label:"title",modelValue:o(e).centrotrabajo_id,"onUpdate:modelValue":a[5]||(a[5]=l=>o(e).centrotrabajo_id=l)},null,8,["options","modelValue"]),s(p,{class:"mt-2",message:o(e).errors.centrotrabajo_id},null,8,["message"])]),o(e).ordentrabajo_ids&&o(e).centrotrabajo_id&&o(e).tipoReporte.value!=2?(c(),n("div",te,[s(j,{for:i.index,value:h[3]},null,8,["for","value"]),s(f,{id:i.index,type:"text",disabled:"",class:"mt-1 block w-full bg-gray-200",modelValue:o(e).TiempoEstimado,"onUpdate:modelValue":a[6]||(a[6]=l=>o(e).TiempoEstimado=l)},null,8,["id","modelValue"])])):m("",!0),o(e).tipoReporte.value==0||o(e).tipoReporte.value==1?(c(),n("div",le,[se,s(o(u),{options:t.actividad_id,label:"title",required:"",modelValue:o(e).actividad_id,"onUpdate:modelValue":a[7]||(a[7]=l=>o(e).actividad_id=l)},null,8,["options","modelValue"]),s(p,{class:"mt-2",message:o(e).errors.actividad_id},null,8,["message"])])):m("",!0),o(e).tipoReporte.value==1?(c(),n("div",de,[re,s(o(u),{options:t.reproceso_id,label:"title",required:"",modelValue:o(e).reproceso_id,"onUpdate:modelValue":a[8]||(a[8]=l=>o(e).reproceso_id=l)},null,8,["options","modelValue"]),s(p,{class:"mt-2",message:o(e).errors.reproceso_id},null,8,["message"])])):m("",!0),o(e).tipoReporte.value==2?(c(),n("div",ne,[ce,s(o(u),{options:t.disponibilidad_id,label:"title",required:"",modelValue:o(e).disponibilidad_id,"onUpdate:modelValue":a[9]||(a[9]=l=>o(e).disponibilidad_id=l)},null,8,["options","modelValue"]),s(p,{class:"mt-2",message:o(e).errors.disponibilidad_id},null,8,["message"])])):m("",!0)]),d("div",me,[t.mensajeFalta!=""?(c(),n("h2",pe,_(t.mensajeFalta),1)):m("",!0),t.mensajeTiemposAuto!=""?(c(),n("h2",ue,_(t.mensajeTiemposAuto),1)):m("",!0),s(I,{disabled:o(e).processing,onClick:a[10]||(a[10]=l=>g("close"))},{default:x(()=>[k(_(i.lang().button.close),1)]),_:1},8,["disabled"]),s($,{class:B(["ml-3",{"opacity-25":o(e).processing}]),disabled:o(e).processing,onClick:O},{default:x(()=>[k(_(o(e).processing?i.lang().button.add+"...":i.lang().button.add),1)]),_:1},8,["class","disabled"])])],40,q)]),_:1},8,["show"])]))}};export{Ve as default};
