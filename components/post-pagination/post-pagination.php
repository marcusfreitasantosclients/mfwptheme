<?php
function mf_post_pagination($component_data){ ?>
    <nav aria-label="Page navigation example" class="mf_post_pagination">
        <div class="pagination justify-content-end my-2">
            <li class="page-item btn_load_more">
                <div class="page-link d-flex justify-content-center align-items-center" style="cursor: pointer">
                    <span>Load more</span>
                    <i class="bx  bx-plus"></i> 
                </div>
            </li>
        </ul>
    </nav>
<?php }