export default function (text: string) { 
	const el = document.createElement('button');
	el.innerText = text;
	return el;
}