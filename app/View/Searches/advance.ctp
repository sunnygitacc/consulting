        <div class="full-container main-content">
            <div class="fixed-container">
                <div class="left-panel">
                    <div class="content-left">
                        <h2 class="whats-avail">Advance Search</h2>
                        <ul class="a-search-ulist">
                            <li>
                                <div class="a-search-check">
                                    <div class="custom-check">
                                        <div class="toogle-tick">
                                        </div>
                                        <input name="amb" type="checkbox" />
                                    </div>
                                </div>
                                <span class="a-search-lebel">Ambition</span>
                            </li>
                            <li>
                                <div class="a-search-check">
                                    <div class="custom-check">
                                        <div class="toogle-tick">
                                        </div>
                                        <input name="hob" type="checkbox" />
                                    </div>
                                </div>
                                <span class="a-search-lebel">Hobbies</span>
                            </li>
                            <li>
                                <div class="a-search-check">
                                    <div class="custom-check">
                                        <div class="toogle-tick">
                                        </div>
                                        <input name="tea" type="checkbox" />
                                    </div>
                                </div>
                                <span class="a-search-lebel">Teams</span>
                            </li>
                            <li>
                                <div class="a-search-check">
                                    <div class="custom-check">
                                        <div class="toogle-tick">
                                        </div>
                                        <input type="checkbox" />
                                    </div>
                                </div>
                                <span class="a-search-lebel">Creativity</span>
                            </li>
                        </ul>

                        <ul class="a-search-ulist">
                            <li>
                                <div class="a-search-check">
                                    <div class="custom-check">
                                        <div class="toogle-tick">
                                        </div>
                                        <input name="user" type="checkbox" />
                                    </div>
                                </div>
                                <span class="a-search-lebel">People</span>
                            </li>
                            <li>
                                <div class="a-search-check">
                                    <div class="custom-check">
                                        <div class="toogle-tick">
                                        </div>
                                        <input name="mentor" type="checkbox" />
                                    </div>
                                </div>
                                <span class="a-search-lebel">Mentors</span>
                            </li>
                            <li>
                                <div class="a-search-check">
                                    <div class="custom-check">
                                        <div class="toogle-tick">
                                        </div>
                                        <input type="checkbox" />
                                    </div>
                                </div>
                                <span class="a-search-lebel">Groups</span>
                            </li>

                        </ul>
                        <ul class="a-search-ulist">
                            <li>
                                <div data-component="accordian" class="search-toggle">
                                    <div data-handle="header" class="search-toggle-lebel">
                                        <span class="search-toggle-inicatior">+</span>
                                        <span class="search-toggle-label">Hometown</span>
                                    </div>
                                    <div data-handle="content" class="search-toggle-content">
                                        <select class="custom-select">
                                            <option>Select</option>
                                            <option>Hometown 1</option>
                                            <option>Hometown 2</option>
                                            <option>Hometown 3</option>
                                            <option>Hometown 4</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div data-component="accordian" class="search-toggle">
                                    <div data-handle="header" class="search-toggle-lebel">
                                        <span class="search-toggle-inicatior">+</span>
                                        <span class="search-toggle-label">Country</span>
                                    </div>
                                    <div data-handle="content" class="search-toggle-content">
                                        <select class="custom-select">
                                            <option>Select</option>
                                            <option>Country1</option>
                                            <option>Country2</option>
                                            <option>Country3</option>
                                            <option>Country4</option>
                                            <option>Country5</option>
                                            <option>Country6</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div data-component="accordian" class="search-toggle">
                                    <div data-handle="header" class="search-toggle-lebel">
                                        <span class="search-toggle-inicatior">+</span>
                                        <span class="search-toggle-label">High School</span>
                                    </div>
                                    <div data-handle="content" class="search-toggle-content">
                                        <select class="custom-select">
                                            <option>Select</option>
                                            <option>High School 1</option>
                                            <option>High School 2</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div data-component="accordian" class="search-toggle">
                                    <div data-handle="header" class="search-toggle-lebel">
                                        <span class="search-toggle-inicatior">+</span>
                                        <span class="search-toggle-label">University</span>
                                    </div>
                                    <div data-handle="content" class="search-toggle-content">
                                        <select class="custom-select">
                                            <option>Select</option>
                                            <option>University 1</option>
                                            <option>University 2</option>
                                            <option>University 3</option>
                                            <option>University 4</option>
                                            <option>University 5</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div data-component="accordian" class="search-toggle">
                                    <div data-handle="header" class="search-toggle-lebel">
                                        <span class="search-toggle-inicatior">+</span>
                                        <span class="search-toggle-label">Company</span>
                                    </div>
                                    <div data-handle="content" class="search-toggle-content">
                                        <select class="custom-select">
                                            <option>Select</option>
                                            <option>Country1</option>
                                            <option>Country2</option>
                                            <option>Country3</option>
                                            <option>Country4</option>
                                            <option>Country5</option>
                                            <option>Country6</option>
                                        </select>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
                <div class="mid-section">
                    <div class="row-mid-notification search-notification">
                        <input value ="<?php if(isset($str)) echo $str; ?>" class="search-notif-input" />
                        <input class="search-notif-button" type="submit" value="&#xf002;" name="search">
                    </div>

                    
                    
                    <div class="row-mid-notification list-notif-search">
                        <ul id="result_pop" >
                            <?Php echo $this->Html->image('loading.gif'); ?>
                        </ul>
                    </div>
                </div>
                <div class="mid-sec-add">
                    <div class="adds-row">ADDS</div>
                    <div class="adds-row">ADDS</div>
                    <div class="adds-row">ADDS</div>
                    <div class="adds-row">ADDS</div>
                </div>
                <div class="right-panel">
                    <div class="right-toggle-button">X</div>
                    <div class="content-right">
                        <div class="friend-mentors">
                            <?php echo $this->element('friend'); ?>
                            <?php echo $this->element('mentor'); ?>
                        </div>

                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>

