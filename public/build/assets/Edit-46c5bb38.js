import{l as E,T as F,y as q,D as B,f as t,a as d,w as y,o as c,b as r,t as u,F as M,k as N,u as s,d as w,n as O,e as T}from"./app-fc6cbe82.js";import{_ as m}from"./InputError-5608eb67.js";import{_ as g,a as S}from"./TextInput-2923ad7e.js";import{_ as D,a as x}from"./SecondaryButton-f81a2274.js";import{_ as z}from"./PrimaryButton-b2522f86.js";import{_ as L}from"./SelectInput-e2662186.js";import{o as A}from"./vue-datepicker-603ea02c.js";/* empty css             */import{C as G}from"./vue-select-0e873f7a.js";const H={class:"space-y-6"},I=["onSubmit"],J={class:"text-lg font-medium text-gray-900 dark:text-gray-100 mb-2"},K={class:"grid grid-cols-1 md:grid-cols-2 gap-6"},P={key:0,id:"SelectVue"},Q={name:"labelSelectVue"},R={key:1,id:"SelectVue"},W={key:2,id:"SelectVue"},X={key:3,class:""},Y={class:"flex justify-end my-8"},re={__name:"Edit",props:{show:Boolean,title:String,user:Object,titulos:Object,roles:Object},emits:["close"],setup(b,{emit:_}){var v;const o=b,U=E({params:{pregunta:""},sexo:[{title:"Masculino",value:"Masculino"},{title:"Femenino",value:"Femenino"}]}),$=o.titulos.map(a=>a.order);let l=F({...Object.fromEntries($.map(a=>[a,""])),role:""});const V=[];o.titulos.forEach(a=>V.push({idd:a.order,label:a.label,type:a.type}));const h=()=>{var a;l.put(route("user.update",(a=o.user)==null?void 0:a.id),{preserveScroll:!0,onSuccess:()=>{_("close"),l.reset()},onError:()=>null,onFinish:()=>null})};q(()=>{var a,i,e,p,n,f,k;o.show&&(l.errors={},l.name=(a=o.user)==null?void 0:a.name,l.email=(i=o.user)==null?void 0:i.email,l.role=((e=o.user)==null?void 0:e.roles)==0?"":(p=o.user)==null?void 0:p.roles[0].name,l.identificacion=(n=o.user)==null?void 0:n.identificacion,l.sexo=(f=o.user)==null?void 0:f.sexo,l.fecha_nacimiento=(k=o.user)==null?void 0:k.fecha_nacimiento,l.errors={})}),B(()=>{});const C=(v=o.roles)==null?void 0:v.map(a=>({label:a.name.replace(/_/g," "),value:a.name})),j=["year","month","calendar"];return(a,i)=>(c(),t("section",H,[d(D,{show:o.show,onClose:i[2]||(i[2]=e=>_("close"))},{default:y(()=>[r("form",{class:"p-6 mb-12",onSubmit:T(h,["prevent"])},[r("h2",J,u(a.lang().label.edit)+" "+u(o.title),1),r("div",K,[(c(),t(M,null,N(V,(e,p)=>r("div",{key:p},[e.type=="foreign"?(c(),t("div",P,[r("label",Q,u(e.label),1),d(s(G),{options:U[e.idd],label:"title",modelValue:s(l)[e.idd],"onUpdate:modelValue":n=>s(l)[e.idd]=n},null,8,["options","modelValue","onUpdate:modelValue"]),d(m,{class:"mt-2",message:s(l).errors[e.idd]},null,8,["message"])])):e.type=="time"?(c(),t("div",R,[d(g,{for:e.label,value:a.lang().label[e.label]},null,8,["for","value"]),d(S,{id:e.idd,type:e.type,class:"mt-1 block w-full",modelValue:s(l)[e.idd],"onUpdate:modelValue":n=>s(l)[e.idd]=n,required:"",placeholder:e.label,error:s(l).errors[e.idd],step:"3600"},null,8,["id","type","modelValue","onUpdate:modelValue","placeholder","error"]),d(m,{class:"mt-2",message:s(l).errors[e.idd]},null,8,["message"])])):e.type=="date"?(c(),t("div",W,[d(g,{for:e.label,value:a.lang().label[e.label]},null,8,["for","value"]),d(s(A),{"is-24":!1,"day-names":a.daynames,format:a.formatToVue,flow:j,"auto-apply":"","enable-time-picker":!1,id:e.idd,class:"mt-1 block w-full",modelValue:s(l)[e.idd],"onUpdate:modelValue":n=>s(l)[e.idd]=n,required:"",placeholder:e.label,error:s(l).errors[e.idd]},null,8,["day-names","format","id","modelValue","onUpdate:modelValue","placeholder","error"]),d(m,{class:"mt-2",message:s(l).errors[e.idd]},null,8,["message"])])):(c(),t("div",X,[d(g,{for:e.label,value:a.lang().label[e.label]},null,8,["for","value"]),d(S,{id:e.idd,type:e.type,class:"mt-1 block w-full",modelValue:s(l)[e.idd],"onUpdate:modelValue":n=>s(l)[e.idd]=n,required:"",placeholder:e.label,error:s(l).errors[e.idd]},null,8,["id","type","modelValue","onUpdate:modelValue","placeholder","error"]),d(m,{class:"mt-2",message:s(l).errors[e.idd]},null,8,["message"])]))])),64)),r("div",null,[d(g,{for:"role",value:a.lang().label.role},null,8,["value"]),d(L,{id:"role",class:"mt-1 block w-full",modelValue:s(l).role,"onUpdate:modelValue":i[0]||(i[0]=e=>s(l).role=e),required:"",dataSet:s(C)},null,8,["modelValue","dataSet"]),d(m,{class:"mt-2",message:s(l).errors.role},null,8,["message"])])]),r("div",Y,[d(x,{disabled:s(l).processing,onClick:i[1]||(i[1]=e=>_("close"))},{default:y(()=>[w(u(a.lang().button.close),1)]),_:1},8,["disabled"]),d(z,{class:O(["ml-3",{"opacity-25":s(l).processing}]),disabled:s(l).processing,onClick:h},{default:y(()=>[w(u(s(l).processing?a.lang().button.save+"...":a.lang().button.save),1)]),_:1},8,["class","disabled"])])],40,I)]),_:1},8,["show"])]))}};export{re as default};