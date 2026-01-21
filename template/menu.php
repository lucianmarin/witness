<div class="menu">
	<div class="center">
	    <h5><?= date('l') ?></h5>
	    <h1>
	        <a href="/" <? if(strpos($self, 'index')): ?>class="selected"<? endif; ?>>
    	        witness
    	    </a>
            <a href="/feed.php" <? if(strpos($self, 'feed')): ?>class="selected"<? endif; ?>>
                feed
            </a>
        	<a href="/mentions.php" <? if(strpos($self, 'mentions')): ?>class="selected"<? endif; ?>>
            	mentions<sup>1</sup>
            </a>
            <a href="/witnesses.php" <? if(strpos($self, 'witnesses')): ?>class="selected"<? endif; ?>>
                add
            </a>
	    </h1>
	</div>
</div>
