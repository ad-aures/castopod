import CodeMirror from "codemirror";
import "codemirror/lib/codemirror.css";

const HTMLEditor = () => {
  const allHTMLEditors = document.querySelectorAll(
    "textarea[data-editor='html']"
  );

  for (let j = 0; j < allHTMLEditors.length; j++) {
    const textarea = allHTMLEditors[j];

    CodeMirror.fromTextArea(textarea, {
      lineNumbers: true,
      mode: { name: "xml", htmlMode: true },
    });
  }
};

export default HTMLEditor;
