<h2>CIME Cheat Sheet</h2>
<div class="mod">
  <div class="col">
    <h3>Format Text</h3>
    <p>Headers</p>
    <pre>
# This is an &lt;h1&gt; tag
## This is an &lt;h2&gt; tag
###### This is an &lt;h6&gt; tag</pre>
    <p>Text styles</p>
    <pre>
*This text will be italic*
_This will also be italic_
**This text will be bold**
__This will also be bold__

*You **can** combine them*</pre>
  </div>
  <div class="col">
    <h3>Lists</h3>
    <p>Unordered</p>
    <pre>
* Item 1
* Item 2
  * Item 2a
  * Item 2b</pre>
    <p>Ordered</p>
    <pre>
1. Item 1
2. Item 2
3. Item 3
  * Item 3a
  * Item 3b</pre>
  </div>
  <div class="col">
    <h3>Miscellaneous</h3>
    <p>Images</p>
    <pre>
![Crew Logo](/images/logo.png)
Format: ![Alt Text](url)</pre>
    <p>Links</p>
    <pre>
http://crew-cr.org - automatic!
[GitHub](http://crew-cr.org)</pre>
  </div>
</div>
<div class="rule"></div>
<div class="mod">
  <h3 class="single">Code Examples in Markdown</h3>
  <div class="col">
    <p>Code block</p>
    <pre>
~~~
function fancyAlert(arg) {
  if(arg) {
    $.facebox({div:'#foo'})
  }
}
~~~</pre>
  </div>
  <div class="col">
    <p>Or, indent your code 4 spaces</p>
    <pre>
Here is a Python code example
without syntax highlighting:

    def foo:
      if not bar:
        return true</pre>
  </div>
  <div class="col">
    <p>Inline code for comments</p>
    <pre>
I think you should use an
`&lt;addr&gt;` element here instead.</pre>
  </div>
</div>