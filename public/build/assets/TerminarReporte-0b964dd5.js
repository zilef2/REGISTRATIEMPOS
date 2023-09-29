import{l as $,T as b,y as x,f as t,a as o,w as m,o as r,b as d,t as u,F as S,k as j,u as s,d as g,n as C,e as N}from"./app-fc6cbe82.js";import{_}from"./InputError-5608eb67.js";import{_ as f,a as h}from"./TextInput-2923ad7e.js";import{_ as B,a as E}from"./SecondaryButton-f81a2274.js";import{_ as F}from"./PrimaryButton-b2522f86.js";import"./vue-select-0e873f7a.js";import{a as T}from"./global-2e02be81.js";const U={class:"space-y-6"},D={class:"text-lg font-medium text-gray-900 dark:text-gray-100"},M={class:"grid grid-cols-1 md:grid-cols-1 md:mx-[100px] mt-8 gap-6"},L={key:0,id:"SelectVue"},O={key:1,class:""},q={class:"my-8 flex justify-end"},K={__name:"TerminarReporte",props:{show:Boolean,title:String,generica:Object},emits:["close"],setup(y,{emit:i}){const c=y,v=$({justNames:["hora_final"]}),l=b({...Object.fromEntries(v.justNames.map(a=>[a,""]))}),w=[{idd:"hora_final",label:"hora final",type:"time",value:l.hora_final,elif:null}];x(()=>{if(c.show){l.errors={},l.hora_final=T();const a=new Date;let n=a.getHours(),e=(n<10?"0":"")+n+":"+(a.getMinutes()<10?"0":"")+a.getMinutes()+":00";l.hora_final=e}});const V=()=>{var a;l.put(route("reporte.update",(a=c.generica)==null?void 0:a.id),{preserveScroll:!0,onSuccess:()=>{i("close"),l.reset()},onError:()=>null,onFinish:()=>null})};return(a,n)=>(r(),t("section",U,[o(B,{show:c.show,onClose:n[2]||(n[2]=e=>i("close"))},{default:m(()=>[d("form",{class:"p-6",onSubmit:n[1]||(n[1]=N((...e)=>a.create&&a.create(...e),["prevent"]))},[d("h2",D,u(a.lang().label.finLaboral),1),d("div",M,[(r(),t(S,null,j(w,(e,k)=>d("div",{key:k},[e.type=="time"?(r(),t("div",L,[o(f,{class:"text-center",for:e.label,value:a.lang().label[e.label]},null,8,["for","value"]),o(h,{id:e.idd,type:e.type,class:"mt-1 pl-4 ml-7 block w-full text-xl text-center",modelValue:s(l)[e.idd],"onUpdate:modelValue":p=>s(l)[e.idd]=p,required:"",placeholder:e.label,error:s(l).errors[e.idd],disabled:"",step:"3600"},null,8,["id","type","modelValue","onUpdate:modelValue","placeholder","error"]),o(_,{class:"mt-2",message:s(l).errors[e.idd]},null,8,["message"])])):(r(),t("div",O,[o(f,{for:e.label,value:a.lang().label[e.label]},null,8,["for","value"]),o(h,{id:e.idd,type:e.type,class:"mt-1 block w-full",modelValue:s(l)[e.idd],"onUpdate:modelValue":p=>s(l)[e.idd]=p,placeholder:e.label,error:s(l).errors[e.idd]},null,8,["id","type","modelValue","onUpdate:modelValue","placeholder","error"]),o(_,{class:"mt-2",message:s(l).errors[e.idd]},null,8,["message"])]))])),64))]),d("div",q,[o(E,{disabled:s(l).processing,onClick:n[0]||(n[0]=e=>i("close"))},{default:m(()=>[g(u(a.lang().button.close),1)]),_:1},8,["disabled"]),o(F,{class:C(["ml-3",{"opacity-25":s(l).processing}]),disabled:s(l).processing,onClick:V},{default:m(()=>[g(u(s(l).processing?a.lang().button.save+"...":a.lang().button.save),1)]),_:1},8,["class","disabled"])])],32)]),_:1},8,["show"])]))}};export{K as default};
