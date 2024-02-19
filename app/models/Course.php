<?php

namespace app\models;

use core\Model;

class Course extends Model
{
	public function getAll()
	{
		$allRows = $this->select([
			'c.id as category_id',
			'c.name as category_name',
			'c.parent as parent_id'],
			'mdl_course_categories as c')
		->orderBy('c.sortorder')->get();		

		// Filtrar apenas as categorias raízes (aquelas que não têm pai)
		$rootCategories = array_filter($allRows, function($row) {
			return $row['parent_id'] === 0;
		});

        // Criar uma função recursiva para montar a árvore de categorias
		$buildTree = function($parentId) use (&$buildTree, $allRows) {
			$categories = [];

			foreach ($allRows as $row) {
				if ($row['parent_id'] === $parentId) {
					$category = [
						'category_id' => $row['category_id'],
						'category_name' => $row['category_name'],
						'courses' => []
					];

					if ($category['courses'] !== null) {
                        // Adiciona o curso ao array de cursos da categoria
						$category['courses'] = $this->select([ 
							'mdl_course.id',
							'mdl_course.fullname',
							'mdl_course.idnumber',
							'mdl_course.category'],
							'mdl_course'
						)->where('category', $row['category_id'])->get();
					}

                    // Recursivamente chama a função para adicionar subcategorias e agrupar cursos
					$category['subcategories'] = $buildTree($row['category_id']);

					$categories[] = $category;
				}
			}

			return $categories;
		};

        // Construir a árvore de categorias a partir das categorias raízes
		$resultados = array_map(function($row) use ($buildTree) {
			return [
				'category_id' => $row['category_id'],
				'category_name' => $row['category_name'],
				'courses' => $this->select([ 
					'mdl_course.id',
					'mdl_course.fullname',
					'mdl_course.idnumber',
					'mdl_course.category'],
					'mdl_course'
				)->where('category', $row['category_id'])->get(),
				'subcategories' => $buildTree($row['category_id'])
			];
		}, $rootCategories);		

        // Retorna os resultados
		return $resultados;
	}
}

