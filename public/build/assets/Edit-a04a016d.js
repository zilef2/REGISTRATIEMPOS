import{l as q,T as B,y as M,D as N,f as t,a as o,w as y,o as c,b as i,t as u,F as O,k as x,u as s,d as $,n as D,e as z}from"./app-074b46c7.js";import{_ as m}from"./InputError-56ccfaaa.js";import{_ as g,a as C}from"./TextInput-d448324e.js";import{_ as L,a as A}from"./SecondaryButton-a93e6dba.js";import{_ as G}from"./PrimaryButton-898ad35f.js";import{_ as H}from"./SelectInput-cd179d42.js";import{o as I}from"./vue-datepicker-f30b8365.js";/* empty css             */import{C as J}from"./vue-select-9fa78435.js";const K={class:"space-y-6"},P=["onSubmit"],Q={class:"text-lg font-medium text-gray-900 dark:text-gray-100 mb-2"},R={class:"grid grid-cols-1 md:grid-cols-2 gap-6"},W={key:0,id:"SelectVue"},X={name:"labelSelectVue"},Y={key:1,id:"SelectVue"},Z={key:2,id:"SelectVue"},ee={key:3,class:""},le={class:"flex justify-end my-8"},ue={__name:"Edit",props:{show:Boolean,title:String,user:Object,titulos:Object,roles:Object},emits:["close"],setup(j,{emit:_}){var v;const d=j,h=q({params:{pregunta:""},onceTime:!0,sexo:[{title:"Masculino",value:"Masculino"},{title:"Femenino",value:"Femenino"}]}),E=d.titulos.map(a=>a.order);let e=B({...Object.fromEntries(E.map(a=>[a,""])),role:""});const V=[];d.titulos.forEach(a=>V.push({idd:a.order,label:a.label,type:a.type}));const f=()=>{var a;e.put(route("user.update",(a=d.user)==null?void 0:a.id),{preserveScroll:!0,onSuccess:()=>{_("close"),e.reset()},onError:()=>null,onFinish:()=>null})};M(()=>{var a,r,l,p,n,k,w,S,b,U;d.show?(e.errors={},e.name=(a=d.user)==null?void 0:a.name,e.email=(r=d.user)==null?void 0:r.email,e.role=((l=d.user)==null?void 0:l.roles)==0?"":(p=d.user)==null?void 0:p.roles[0].name,e.identificacion=(n=d.user)==null?void 0:n.identificacion,e.sexo=(k=d.user)==null?void 0:k.sexo,e.fecha_nacimiento=(w=d.user)==null?void 0:w.fecha_nacimiento,e.celular=(S=d.user)==null?void 0:S.celular,e.area=(b=d.user)==null?void 0:b.area,e.cargo=(U=d.user)==null?void 0:U.cargo,h.onceTime=!1):(e.name=null,e.email=null,e.role=null,e.identificacion=null,e.sexo=null,e.fecha_nacimiento=null,e.celular=null,e.area=null,e.cargo=null)}),N(()=>{});const F=(v=d.roles)==null?void 0:v.map(a=>({label:a.name.replace(/_/g," "),value:a.name})),T=["year","month","calendar"];return(a,r)=>(c(),t("section",K,[o(L,{show:d.show,onClose:r[2]||(r[2]=l=>_("close"))},{default:y(()=>[i("form",{class:"p-6 mb-12",onSubmit:z(f,["prevent"])},[i("h2",Q,u(a.lang().label.edit)+" "+u(d.title),1),i("div",R,[(c(),t(O,null,x(V,(l,p)=>i("div",{key:p},[l.type=="foreign"?(c(),t("div",W,[i("label",X,u(l.label),1),o(s(J),{options:h[l.idd],label:"title",modelValue:s(e)[l.idd],"onUpdate:modelValue":n=>s(e)[l.idd]=n},null,8,["options","modelValue","onUpdate:modelValue"]),o(m,{class:"mt-2",message:s(e).errors[l.idd]},null,8,["message"])])):l.type=="time"?(c(),t("div",Y,[o(g,{for:l.label,value:a.lang().label[l.label]},null,8,["for","value"]),o(C,{id:l.idd,type:l.type,class:"mt-1 block w-full",modelValue:s(e)[l.idd],"onUpdate:modelValue":n=>s(e)[l.idd]=n,required:"",placeholder:l.label,error:s(e).errors[l.idd],step:"3600"},null,8,["id","type","modelValue","onUpdate:modelValue","placeholder","error"]),o(m,{class:"mt-2",message:s(e).errors[l.idd]},null,8,["message"])])):l.type=="date"?(c(),t("div",Z,[o(g,{for:l.label,value:a.lang().label[l.label]},null,8,["for","value"]),o(s(I),{"is-24":!1,"day-names":a.daynames,format:a.formatToVue,flow:T,"auto-apply":"","enable-time-picker":!1,id:l.idd,class:"mt-1 block w-full",modelValue:s(e)[l.idd],"onUpdate:modelValue":n=>s(e)[l.idd]=n,required:"",placeholder:l.label,error:s(e).errors[l.idd]},null,8,["day-names","format","id","modelValue","onUpdate:modelValue","placeholder","error"]),o(m,{class:"mt-2",message:s(e).errors[l.idd]},null,8,["message"])])):(c(),t("div",ee,[o(g,{for:l.label,value:a.lang().label[l.label]},null,8,["for","value"]),o(C,{id:l.idd,type:l.type,class:"mt-1 block w-full",modelValue:s(e)[l.idd],"onUpdate:modelValue":n=>s(e)[l.idd]=n,required:"",placeholder:l.label,error:s(e).errors[l.idd]},null,8,["id","type","modelValue","onUpdate:modelValue","placeholder","error"]),o(m,{class:"mt-2",message:s(e).errors[l.idd]},null,8,["message"])]))])),64)),i("div",null,[o(g,{for:"role",value:a.lang().label.role},null,8,["value"]),o(H,{id:"role",class:"mt-1 block w-full",modelValue:s(e).role,"onUpdate:modelValue":r[0]||(r[0]=l=>s(e).role=l),required:"",dataSet:s(F)},null,8,["modelValue","dataSet"]),o(m,{class:"mt-2",message:s(e).errors.role},null,8,["message"])])]),i("div",le,[o(A,{disabled:s(e).processing,onClick:r[1]||(r[1]=l=>_("close"))},{default:y(()=>[$(u(a.lang().button.close),1)]),_:1},8,["disabled"]),o(G,{class:D(["ml-3",{"opacity-25":s(e).processing}]),disabled:s(e).processing,onClick:f},{default:y(()=>[$(u(s(e).processing?a.lang().button.save+"...":a.lang().button.save),1)]),_:1},8,["class","disabled"])])],40,P)]),_:1},8,["show"])]))}};export{ue as default};