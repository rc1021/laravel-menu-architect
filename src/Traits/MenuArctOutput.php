<?php

namespace Rc1021\LaravelMenuArchitect\Traits;

use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Html;

trait MenuArctOutput
{
    public function toBootstrap() 
    {
        $fnBuilder = function($items) use (&$fnBuilder) {
            $menu = Menu::new();
            foreach ($items as $item) {
                $class = (isset($item['class'])) ? $item['class'] : '';
                if(isset($item['children'])) {
                    $caret = ($item['depth'] < 1) ? ' <span class="caret"></span>' : '';
                    $menu->submenu(
                        Link::to('#', $item['label'].$caret)
                            
                            ->addClass('dropdown-toggle')
                            ->addClass($class)
                            ->setAttributes([
                                'data-toggle' => 'dropdown', 
                                'role' => 'button'
                            ]), 
                        $fnBuilder($item['children'])->addClass('dropdown-menu')
                            ->addParentClass(($item['depth'] >= 1) ? 'dropdown-submenu' : '')
                    );
                }
                else {
                    $menu->add(Link::to($item['render_path'], $item['label'])->addClass($class));
                }
            }
            return $menu;
        };

        return $fnBuilder($this->toArray())->addClass('nav navbar-nav')->wrap('div', ['class' => 'collapse navbar-collapse']);
    }

    public function toNestable() 
    {
        $fnBuilder = function($items) use (&$fnBuilder) {
            $menu = Menu::new();
            foreach ($items as $item) {
                $class = (isset($item['class'])) ? $item['class'] : '';

                $row_html = '<div class="dd-handle"><span class="dd-content">'.Link::to($item['render_path'], $item['label']).'</span></div>';
                if(isset($item['children'])) {
                    $row_html .= $fnBuilder($item['children']);
                }

                $link = Html::raw($row_html)
                    ->setParentAttribute('data-id', $item['id'])
                    ->addParentClass('dd-item '.$class);

                $menu->add($link);
            }
            return $menu;
        };
        
        return $fnBuilder($this->toArray())
                    ->setWrapperTag('ol')
                    ->addClass('dd-list')
                    ->setParentTag('li')
                    ->wrap('div', [
                        'id' => $this->m_menu->name,
                        'class' => 'dd'
                    ]);
    }

    public function toAdminlteSidebar() 
    {
        $fnBuilder = function($items) use (&$fnBuilder) {
            $menu = Menu::new();
            foreach ($items as $item) {

                $class = (isset($item['class'])) ? $item['class'] : '';

                if($item['depth'] == 0 && !isset($item['children'])) {
                    $link = Html::raw($item['label'])->addParentClass('header');
                    $menu->add($link);
                }
                else {
                    if(isset($item['children'])) {
                        $row_html = '<i class="fa fa-circle-o"></i> <span>'.$item['label'].'</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>';
                        $link = Link::to("#", $row_html);
                        $menu->submenu($link, $fnBuilder($item['children'])
                             ->addClass('treeview-menu')->addParentClass('treeview'));
                    }
                    else {
                        $row_html = '<i class="fa fa-circle-o"></i> '.$item['label'];
                        $menu->add(Link::to($item['render_path'], $row_html));
                    }
                }

            }
            return $menu;
        };
        
        return $fnBuilder($this->toArray())
                    ->setWrapperTag('ul')
                    ->addClass('sidebar-menu tree')
                    ->setAttribute('data-widget', 'tree')
                    ->setParentTag('li');
    }
}