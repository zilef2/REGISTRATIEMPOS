import{l as N,T as B,y as O,f as c,a as s,w as b,o as _,b as n,t as p,F as x,k as A,u as l,d as w,n as L,e as D}from"./app-f2326059.js";import{_ as v}from"./InputError-111b2d05.js";import{_ as C,a as $}from"./TextInput-235477d9.js";import{_ as M,a as R}from"./SecondaryButton-06ec2122.js";import{_ as T}from"./PrimaryButton-8575f0a0.js";import{C as q}from"./vue-select-6d992ad4.js";import"./vue-datepicker-29ed76b2.js";import{L as r}from"./global-b0d05eda.js";const I={class:"space-y-6"},P={class:"text-lg font-medium text-gray-900 dark:text-gray-100"},G={class:"grid grid-cols-1 md:grid-cols-2 gap-6"},H={key:0,id:"SelectVue"},J={name:"labelSelectVue"},K={key:1,id:"SelectVue"},Q={key:2,class:""},W={class:"my-8 flex justify-end"},oe={__name:"Edit",props:{show:Boolean,title:String,generica:Object,losSelect:Object},emits:["close"],setup(E,{emit:g}){const d=E,m=N({justNames:["codigo","cantidad","fecha","hora_inicial","actividad_id","centrotrabajo_id","disponibilidad_id","material_id","operario_id","ordentrabajo_id","calendario_id","pieza_id","reproceso_id"],actividad_id:d.losSelect.actividad,centrotrabajo_id:d.losSelect.centrotrabajo,disponibilidad_id:d.losSelect.disponibilidad,material_id:d.losSelect.material,ordentrabajo_id:d.losSelect.ordentrabajo,pieza_id:d.losSelect.pieza,reproceso_id:d.losSelect.reproceso}),e=B({...Object.fromEntries(m.justNames.map(a=>[a,""]))}),U=[{idd:"codigo",label:"codigo",type:"text",value:e.codigo,elif:null},{idd:"fecha",label:"fecha",type:"date",value:e.fecha,elif:null},{idd:"hora_inicial",label:"hora inicial",type:"time",value:e.hora_inicial,elif:null},{idd:"actividad_id",label:"Actividad",type:"id",value:e.actividad_id,elif:null},{idd:"centrotrabajo_id",label:"Centrotrabajo",type:"id",value:e.centrotrabajo_id,elif:null},{idd:"material_id",label:"Material",type:"id",value:e.material_id,elif:null},{idd:"ordentrabajo_id",label:"Ordentrabajo",type:"id",value:e.ordentrabajo_id,elif:null},{idd:"pieza_id",label:"Pieza",type:"id",value:e.pieza_id,elif:null},{idd:"cantidad",label:"cantidad (pieza)",type:"text",value:e.cantidad,elif:"pieza_id"},{idd:"disponibilidad_id",label:"Disponibilidad",type:"id",value:e.disponibilidad_id,elif:null},{idd:"reproceso_id",label:"Reproceso",type:"id",value:e.reproceso_id,elif:null}];O(()=>{var a,o,i,u,t,y,h,f,j,S,V,z,k;d.show&&(e.errors={},e.codigo=(a=d.generica)==null?void 0:a.codigo,e.cantidad=(o=d.generica)==null?void 0:o.cantidad,e.fecha=(i=d.generica)==null?void 0:i.fecha,e.hora_inicial=(u=d.generica)==null?void 0:u.hora_inicial,e.actividad_id=(t=d.generica)==null?void 0:t.actividad_s,e.centrotrabajo_id=(y=d.generica)==null?void 0:y.centrotrabajo_s,e.disponibilidad_id=(h=d.generica)==null?void 0:h.disponibilidad_s,e.material_id=(f=d.generica)==null?void 0:f.material_s,e.operario_id=(j=d.generica)==null?void 0:j.operario_s,e.ordentrabajo_id=(S=d.generica)==null?void 0:S.ordentrabajo_s,e.calendario_id=(V=d.generica)==null?void 0:V.calendario_s,e.pieza_id=(z=d.generica)==null?void 0:z.pieza_s,e.reproceso_id=(k=d.generica)==null?void 0:k.reproceso_s)});const F=()=>{var o;let a=r(d.losSelect.actividad,e.actividad_id);e.actividad_id=a!=""?a:"",a=r(d.losSelect.centrotrabajo,e.centrotrabajo_id),e.centrotrabajo_id=a!=""?a:"",a=r(d.losSelect.disponibilidad,e.disponibilidad_id),e.disponibilidad_id=a!=""?a:"",a=r(d.losSelect.material,e.material_id),e.material_id=a!=""?a:"",a=r(d.losSelect.ordentrabajo,e.ordentrabajo_id),e.ordentrabajo_id=a!=""?a:"",a=r(d.losSelect.pieza,e.pieza_id),e.pieza_id=a!=""?a:"",a=r(d.losSelect.reproceso,e.reproceso_id),e.reproceso_id=a!=""?a:"",e.put(route("reporte.update",(o=d.generica)==null?void 0:o.id),{preserveScroll:!0,onSuccess:()=>{g("close"),e.reset()},onError:()=>null,onFinish:()=>null})};return(a,o)=>(_(),c("section",I,[s(M,{show:d.show,onClose:o[2]||(o[2]=i=>g("close"))},{default:b(()=>[n("form",{class:"p-6",onSubmit:o[1]||(o[1]=D((...i)=>a.create&&a.create(...i),["prevent"]))},[n("h2",P,p(a.lang().label.edit)+" "+p(d.title),1),n("div",G,[(_(),c(x,null,A(U,(i,u)=>n("div",{key:u},[i.type=="id"?(_(),c("div",H,[n("label",J,p(i.label),1),s(l(q),{options:m[i.idd],label:"title",modelValue:l(e)[i.idd],"onUpdate:modelValue":t=>l(e)[i.idd]=t,value:m[i.idd][d.generica.actividad_id]},null,8,["options","modelValue","onUpdate:modelValue","value"]),s(v,{class:"mt-2",message:l(e).errors[i.idd]},null,8,["message"])])):i.type=="time"?(_(),c("div",K,[s(C,{for:i.label,value:a.lang().label[i.label]},null,8,["for","value"]),s($,{id:i.idd,type:i.type,class:"mt-1 block w-full",modelValue:l(e)[i.idd],"onUpdate:modelValue":t=>l(e)[i.idd]=t,required:"",placeholder:i.label,error:l(e).errors[i.idd],step:"3600"},null,8,["id","type","modelValue","onUpdate:modelValue","placeholder","error"]),s(v,{class:"mt-2",message:l(e).errors[i.idd]},null,8,["message"])])):(_(),c("div",Q,[s(C,{for:i.label,value:a.lang().label[i.label]},null,8,["for","value"]),s($,{id:i.idd,type:i.type,class:"mt-1 block w-full",modelValue:l(e)[i.idd],"onUpdate:modelValue":t=>l(e)[i.idd]=t,placeholder:i.label,error:l(e).errors[i.idd]},null,8,["id","type","modelValue","onUpdate:modelValue","placeholder","error"]),s(v,{class:"mt-2",message:l(e).errors[i.idd]},null,8,["message"])]))])),64))]),n("div",W,[s(R,{disabled:l(e).processing,onClick:o[0]||(o[0]=i=>g("close"))},{default:b(()=>[w(p(a.lang().button.close),1)]),_:1},8,["disabled"]),s(T,{class:L(["ml-3",{"opacity-25":l(e).processing}]),disabled:l(e).processing,onClick:F},{default:b(()=>[w(p(l(e).processing?a.lang().button.save+"...":a.lang().button.save),1)]),_:1},8,["class","disabled"])])],32)]),_:1},8,["show"])]))}};export{oe as default};
