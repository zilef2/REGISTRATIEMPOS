import"./app-fc6cbe82.js";function p(e,t){let r="";if(typeof t=="string"){for(const n of e)if(n.title===t){console.log("🧈 "+n.value+" searchValue:",t),r=n.value;break}}else for(const n of e)if(n.title===t.title){r=n.value;break}return r}function $(e,t){let r=new Date(e);r=new Date(r.getTime()+5*60*60*1e3);const n=r.getDate().toString().padStart(2,"0"),o=c((r.getMonth()+1).toString().padStart(2,"0"));let i=r.getFullYear(),s=new Date().getFullYear();if(t=="conLaHora"){let a=r.getHours();const l=a>=12?" PM":" AM";a=a%12||12;let u=a+":"+(r.getMinutes()<10?"0":"")+r.getMinutes()+l;if(s==i)return`${n}-${o} | ${u}`;{let f=i.toString().slice(-2);return`${n}-${o}-${f} | ${u}`}}else{if(s==i)return`${n}-${o}`;{let a=i.toString().slice(-2);return`${n}-${o}-${a}`}}}function D(e){if(e===null)return"";const[t,r,n]=e.split(":");return new Date(2023,7,5,parseInt(t),parseInt(r)).toLocaleString("es-CO",{hour:"numeric",minute:"2-digit",hour12:!0})}function F(e){let t;e?t=new Date(e):t=new Date;let r=t.getHours();return`${(r<10?"0":"")+r+":"+(t.getMinutes()<10?"0":"")+t.getMinutes()+":00"}`}function c(e){if(e==1)return"Enero";if(e==2)return"Febrero";if(e==3)return"Marzo";if(e==4)return"Abril";if(e==5)return"Mayo";if(e==6)return"Junio";if(e==7)return"Julio";if(e==8)return"Agosto";if(e==9)return"Septiembre";if(e==10)return"Octubre";if(e==11)return"Noviembre";if(e==12)return"Diciembre"}function M(e){const t=new Date(e),r=t.getFullYear(),n=("0"+(t.getMonth()+1)).slice(-2),o=("0"+t.getDate()).slice(-2),i=("0"+t.getHours()).slice(-2),s=("0"+t.getMinutes()).slice(-2);return`${r}-${n}-${o}T${i}:${s}`}function v(e,t="",r=!1){let n=0;return t===""?e.forEach((i,s,a)=>{n+=i}):r?e.forEach((i,s,a)=>{let l=i[t].split(":")[0];l=parseInt(l),n+=l}):e.forEach((i,s,a)=>{n+=i[t]}),g(n/e.length,1,!1)}function g(e,t,r){if(e+="",e=parseFloat(e.replace(/[^0-9\.]/g,"")),t=t||0,isNaN(e)||e===0)return parseFloat("0").toFixed(t);e=""+e.toFixed(t);for(var n=e.split(" "),o=/(\d+)(\d{3})/;o.test(n[0]);)n[0]=n[0].replace(o,"$1.$2");return r?"$"+n.join(" "):n.join(" ")}function w(e){const t=new Date().getFullYear(),r=new Date(e).getFullYear();return t-r}function y(e,t=10){if(e){const r=e.split(" ");return r.length>t?r.slice(0,t).join(" ")+"...":e}}function S(e,t,r="uno"){return e=t.map(n=>({label:n.nombre,value:n.id})),e.unshift({label:"Seleccione "+r,value:0}),e}export{w as C,p as L,y as P,M as T,F as a,v as b,D as c,$ as f,g as n,S as v};