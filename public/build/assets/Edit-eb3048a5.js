import{l as S,T as $,D as b,y as C,f as r,a as d,w as m,o as c,b as i,t as p,F as j,k as U,u as a,d as y,n as B,e as F}from"./app-f2326059.js";import{_}from"./InputError-111b2d05.js";import{_ as h,a as V}from"./TextInput-235477d9.js";import{_ as M,a as N}from"./SecondaryButton-06ec2122.js";import{_ as O}from"./PrimaryButton-8575f0a0.js";import{C as q}from"./vue-select-6d992ad4.js";import"./vue-datepicker-29ed76b2.js";const D={class:"space-y-6"},T={class:"text-lg font-medium text-gray-900 dark:text-gray-100"},x={class:"grid grid-cols-1 md:grid-cols-2 gap-6"},z={key:0,id:"SelectVue"},A={name:"labelSelectVue"},L={key:1,id:"SelectVue"},P={key:2,class:""},R={class:"my-8 flex justify-end"},X={__name:"Edit",props:{show:Boolean,title:String,generica:Object,titulos:Object},emits:["close"],setup(f,{emit:u}){const o=f,g=S({}),k=o.titulos.map(l=>l.order),s=$({...Object.fromEntries(k.map(l=>[l,""]))});b(()=>{if(o.numberPermissions>8){const l=Math.floor(Math.random()*9+0);s.nombre="admin orden trabajo "+l,s.codigo=l}});const v=[];o.titulos.forEach(l=>{v.push({idd:l.order,label:l.label,type:l.type,value:s[l.order]})}),C(()=>{o.show&&(s.errors={},o.titulos.forEach(l=>{s[l.order]=o.generica[l.order]}))});const w=()=>{var l;s.put(route("actividad.update",(l=o.generica)==null?void 0:l.id),{preserveScroll:!0,onSuccess:()=>{u("close"),s.reset()},onError:()=>null,onFinish:()=>null})};return(l,n)=>(c(),r("section",D,[d(M,{show:o.show,onClose:n[2]||(n[2]=e=>u("close"))},{default:m(()=>[i("form",{class:"p-6",onSubmit:n[1]||(n[1]=F((...e)=>l.create&&l.create(...e),["prevent"]))},[i("h2",T,p(l.lang().label.edit)+" "+p(o.title),1),i("div",x,[(c(),r(j,null,U(v,(e,E)=>i("div",{key:E},[e.type=="id"?(c(),r("div",z,[i("label",A,p(e.label),1),d(a(q),{options:g[e.idd],label:"title",modelValue:a(s)[e.idd],"onUpdate:modelValue":t=>a(s)[e.idd]=t,value:g[e.idd][o.generica.actividad_id]},null,8,["options","modelValue","onUpdate:modelValue","value"]),d(_,{class:"mt-2",message:a(s).errors[e.idd]},null,8,["message"])])):e.type=="time"?(c(),r("div",L,[d(h,{for:e.label,value:l.lang().label[e.label]},null,8,["for","value"]),d(V,{id:e.idd,type:e.type,class:"mt-1 block w-full",modelValue:a(s)[e.idd],"onUpdate:modelValue":t=>a(s)[e.idd]=t,required:"",placeholder:e.label,error:a(s).errors[e.idd],step:"3600"},null,8,["id","type","modelValue","onUpdate:modelValue","placeholder","error"]),d(_,{class:"mt-2",message:a(s).errors[e.idd]},null,8,["message"])])):(c(),r("div",P,[d(h,{for:e.label,value:l.lang().label[e.label]},null,8,["for","value"]),d(V,{id:e.idd,type:e.type,class:"mt-1 block w-full",modelValue:a(s)[e.idd],"onUpdate:modelValue":t=>a(s)[e.idd]=t,required:"",placeholder:e.label,error:a(s).errors[e.idd]},null,8,["id","type","modelValue","onUpdate:modelValue","placeholder","error"]),d(_,{class:"mt-2",message:a(s).errors[e.idd]},null,8,["message"])]))])),64))]),i("div",R,[d(N,{disabled:a(s).processing,onClick:n[0]||(n[0]=e=>u("close"))},{default:m(()=>[y(p(l.lang().button.close),1)]),_:1},8,["disabled"]),d(O,{class:B(["ml-3",{"opacity-25":a(s).processing}]),disabled:a(s).processing,onClick:w},{default:m(()=>[y(p(a(s).processing?l.lang().button.save+"...":l.lang().button.save),1)]),_:1},8,["class","disabled"])])],32)]),_:1},8,["show"])]))}};export{X as default};
