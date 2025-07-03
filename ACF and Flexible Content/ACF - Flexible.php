	<?php $show_this_section = get_field('show_this_section');  ?>
                                         <?php if($show_this_section == "true"):  ?>
										<?php if (have_rows('video_type')): ?>
											<?php while (have_rows('video_type')): the_row(); ?>
												<?php if (get_row_layout() == 'youtubevimeo'): ?>
													<?php
													$video_link = get_sub_field('video_link');
													if ($video_link):
													?>
														<div class="video_section embed_video_main">
															<?php echo $video_link; ?>
														</div>
													<?php endif; ?>
												<?php elseif (get_row_layout() == 'mp4'): ?>
													<?php
													$mp4_video = get_sub_field('mp4_video');
													if ($mp4_video):
														$mp4_video_url =  $mp4_video['url'];
													?>
														<div class="video_section mp4_video_main">
															<div class="video_main_video">
																<video class="video-player" controls> <!-- Add <?php //echo esc_attr($video_attributes); 
																												?> inside if using dynamic attributes -->
																	<source src="<?php echo esc_url($mp4_video_url); ?>" type="video/mp4">
																	Your browser does not support the video tag.
																</video>
															</div>
														</div>
													<?php endif; ?>
												<?php endif; ?>
											<?php endwhile; ?>
										<?php endif; ?>
										<?php endif; ?>