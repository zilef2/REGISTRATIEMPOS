import{l as w,T as x,y as $,f as u,a as o,w as f,o as g,b as i,t as m,u as t,F as C,k as V,d as _,n as j,e as E,s as B,x as F}from"./app-f2326059.js";import{_ as v}from"./InputError-111b2d05.js";import{_ as d,a as N}from"./TextInput-235477d9.js";import{_ as U,a as D}from"./SecondaryButton-06ec2122.js";import{_ as M}from"./PrimaryButton-8575f0a0.js";import{_ as O}from"./Checkbox-0cd023d4.js";const T={class:"space-y-6"},q=["onSubmit"],z={class:"text-lg font-medium text-gray-900 dark:text-gray-100"},A={class:"my-6 space-y-4"},L={class:"flex justify-start items-center space-x-2 mt-2"},G={class:"grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 mt-2"},H=["id","value"],I={class:"flex justify-end"},X={__name:"Edit",props:{show:Boolean,title:String,role:Object,permissions:Object},emits:["close"],setup(b,{emit:c}){const r=b,n=w({multipleSelect:!1}),e=x({name:"",permissions:[]}),h=()=>{var s;e.put(route("role.update",(s=r.role)==null?void 0:s.id),{preserveScroll:!0,onSuccess:()=>{c("close"),e.reset(),n.multipleSelect=!1},onError:()=>null,onFinish:()=>null})};$(()=>{var s,l,a;r.show&&(e.errors={},e.name=(s=r.role)==null?void 0:s.name,e.permissions=(l=r.role.permissions)==null?void 0:l.map(p=>p.id)),r.permissions.length==((a=r.role)==null?void 0:a.permissions.length)?n.multipleSelect=!0:n.multipleSelect=!1});const k=s=>{s.target.checked===!1?e.permissions=[]:(e.permissions=[],r.permissions.forEach(l=>{e.permissions.push(l.id)}))},y=()=>{r.permissions.length==e.permissions.length?n.multipleSelect=!0:n.multipleSelect=!1};return(s,l)=>(g(),u("section",T,[o(U,{show:r.show,onClose:l[4]||(l[4]=a=>c("close"))},{default:f(()=>[i("form",{class:"p-6",onSubmit:E(h,["prevent"])},[i("h2",z,m(s.lang().label.edit)+" "+m(r.title),1),i("div",A,[i("div",null,[o(d,{for:"name",value:s.lang().label.role},null,8,["value"]),o(N,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:t(e).name,"onUpdate:modelValue":l[0]||(l[0]=a=>t(e).name=a),required:"",placeholder:s.lang().placeholder.name,error:t(e).errors.name},null,8,["modelValue","placeholder","error"]),o(v,{class:"mt-2",message:t(e).errors.name},null,8,["message"])]),i("div",null,[o(d,{value:s.lang().label.permission},null,8,["value"]),o(v,{class:"mt-2",message:t(e).errors.permissions},null,8,["message"]),i("div",L,[o(O,{id:"permission-all",checked:n.multipleSelect,"onUpdate:checked":l[1]||(l[1]=a=>n.multipleSelect=a),onChange:k},null,8,["checked"]),o(d,{for:"permission-all",value:s.lang().label.check_all},null,8,["value"])]),i("div",G,[(g(!0),u(C,null,V(r.permissions,(a,p)=>(g(),u("div",{class:"flex items-center justify-start space-x-2",key:p},[B(i("input",{onChange:y,class:"rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-primary dark:text-primary shadow-sm focus:ring-primary/80 dark:focus:ring-primary dark:focus:ring-offset-gray-800 dark:checked:bg-primary dark:checked:border-primary",type:"checkbox",id:"permission_"+a.id,value:a.id,"onUpdate:modelValue":l[2]||(l[2]=S=>t(e).permissions=S)},null,40,H),[[F,t(e).permissions]]),o(d,{for:"permission_"+a.id,value:a.name},null,8,["for","value"])]))),128))])])]),i("div",I,[o(D,{disabled:t(e).processing,onClick:l[3]||(l[3]=a=>c("close"))},{default:f(()=>[_(m(s.lang().button.close),1)]),_:1},8,["disabled"]),o(M,{class:j(["ml-3",{"opacity-25":t(e).processing}]),disabled:t(e).processing,onClick:h},{default:f(()=>[_(m(t(e).processing?s.lang().button.save+"...":s.lang().button.save),1)]),_:1},8,["class","disabled"])])],40,q)]),_:1},8,["show"])]))}};export{X as default};